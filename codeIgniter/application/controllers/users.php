<?php

include_once 'controlador.php';

class Users extends Controlador {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->library('ion_auth');
        $this->load->library('session');
    }

    public function register() {
        if (parent::in_group("admin")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'required');
            $this->form_validation->set_rules('mail', 'Mail', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('group', 'Rol', 'required');
            $data['grupos'] = $this->ion_auth->groups()->result();
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('user/register', $data);
                $this->load->view('templates/footer');
            } else {
                $this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['mail'], array("nombres" => $_POST['nombres'], "apellidos" => $_POST['apellidos']), array($_POST['group']));
                $this->load->view('templates/header');
                $this->parser->parse('user/register_success', $data);
                $this->load->view('templates/footer');
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $data['message'] = $_SESSION['message'];
            $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
            $this->form_validation->set_rules('password', 'Contraseña', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('user/login', $data);
                $this->load->view('templates/footer');
            } else {

                if ($this->ion_auth->login($_POST['username'], $_POST['password'], true) == FALSE) {
                    $data['message'] = "Usuario o contraseña inválido";
                    $this->load->view('templates/header');
                    $this->parser->parse('user/login', $data);
                    $this->load->view('templates/footer');
                } else {
                    $_SESSION['auth'] = 1;
                    $_SESSION['user'] = $this->ion_auth->user()->row();
                    $_SESSION['user_id'] = $_SESSION['user']->id;
                    if ($_SESSION['user']->establecimiento->id != 0)
                        $_SESSION['establecimiento'] = $_SESSION['user']->establecimiento->ds_establecimiento;
                    else
                        $_SESSION['establecimiento'] = "Visión global";
                    $_SESSION['establecimiento_id'] = $_SESSION['user']->establecimiento->id;
                    redirect("index/");
                }
            }
            $_SESSION['message'] = "";
        }else {
            redirect("index/");
        }
    }

    public function logout() {
        $message = 'Gracias por utilizar el sistema ' . $_SESSION['user']->username . '! Tu sesión ha sido cerrada exitosamente.';
        $_SESSION['message'] = $message;
        $this->ion_auth->logout();
        redirect("users/index/");
    }

    public function buscar() {
        if (parent::in_group("admin")) {

            $this->load->helper('form');
            $this->load->helper('url');
            if ($this->input->post('busqueda') == 'si') {

                $data["users"] = $this->ion_auth->like("nombres", $_POST['nombres'])->like("apellidos", $_POST['apellidos'])->like("username", $_POST['username'])->like("email", $_POST['mail'])->where("active", $_POST['vigente'])->users()->result();
                foreach ($data[users] as $u) {
                    $groups = $this->ion_auth->get_users_groups($u->id)->result();
                    $u->groups = "";
                    foreach ($groups as $g) {
                        $u->groups = $g->description;
                    }
                }
                $data['total'] = count($data['users']);
            }
            $data['last_page'] = $data['total'] / 10;
            $data['page'] = $_POST["page"];
            $data['parametros'] = $_POST;
            $this->load->view('templates/header');
            $this->parser->parse('user/buscar', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function user_data($id) {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Contraseña', 'matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirmar Contraseña');
        $this->form_validation->set_rules('mail', 'Mail', 'required');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('group', 'Rol', 'required');
        $data['grupos'] = $this->ion_auth->groups()->result();
        $data['user'] = $this->ion_auth->user($id)->row();

        $groups = $this->ion_auth->get_users_groups($data['user']->id)->result();
        foreach ($groups as $g) {
            $data['user']->group = $g;
        }

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('user/user_data', $data);
            $this->load->view('templates/footer');
        } else {
            $user_data = array("username" => $_POST['username'], "email" => $_POST['mail'], "nombres" => $_POST['nombres'], "apellidos" => $_POST['apellidos']);
            if ($_POST['password'] != "") {
                $user_data['password'] = $_POST['password'];
            }
            $this->ion_auth->update($id, $user_data);
            $this->ion_auth->remove_from_group(NULL, $id);
            $this->ion_auth->add_to_group($_POST['group'], $id);
            $data['message'] = "Usuario modificado con éxito";
            $data['id'] = $id;
            $data['user'] = $this->ion_auth->user($id)->row();
            $groups = $this->ion_auth->get_users_groups($data['user']->id)->result();
            foreach ($groups as $g) {
                $data['user']->group = $g;
            }
            $this->load->view('templates/header');
            $this->parser->parse('user/user_data', $data);
            $this->load->view('templates/footer');
        }
        
    }
    public function error(){
            $data["error_message"] = "Usted no tiene permiso para acceder a esta funcion";
            $this->load->view('templates/header');
            $this->parser->parse('user/error', $data);
            $this->load->view('templates/footer');
        }

}

?>
