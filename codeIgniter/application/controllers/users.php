<?php
include_once 'controlador.php';

class Users extends Controlador {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
    }

    public function login() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('user/login', $data);
            $this->load->view('templates/footer');
        } else {
            $u = new User();
            $u->where('username', $_POST['username'])->where('password', $_POST['password'])->get();
            if ($u->exists()) {
                $_SESSION['auth'] = 1;
                $_SESSION['user'] = $u;
                $_SESSION['user_id'] = $u->id;
                $_SESSION['establecimiento'] = $u->establecimiento->ds_establecimiento;
                $_SESSION['establecimiento_id'] = $u->establecimiento->id;
                redirect("/");
            }
        }
    }
}

?>
