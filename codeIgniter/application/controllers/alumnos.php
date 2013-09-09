<?php

include_once 'controlador.php';

class Alumnos extends Controlador {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->library('personalibrary');
        $this->load->model('anio_nivel');
        $this->load->model('ley_educacion');
    }

    public function create() {
        if(parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $data = $this->personalibrary->get_create_view_data();
            $exists = $this->personalibrary->person_exists($_POST['identificacion_0_']['cd_identificacion'], $_POST['identificacion_0_']['numero_identificacion'], -1);
            if ($this->form_validation->run() === FALSE || $exists) {
                $this->load->view('templates/header');
                $this->parser->parse('alumno/create', $data);
                $this->load->view('templates/footer');
            } else {
                $a = $this->save_data();
                $av = new Alumno_vigencia();
                $av->estado = 1;
                $av->fecha = $_POST["dt_ingreso"];
                $av->save(array($a));

                redirect("alumnos/alumno_data/" . $a->persona->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function modify($id) {
        if(parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->load->model('Alumno');
            $this->load->model('Establecimiento');
            $this->load->model('Estado_civil');
            $this->load->model('Widentificacion');
            $this->load->model('Localidad');
            $this->load->model('Country');
            $this->load->model('Persona');
            $this->load->model('State');
            $this->load->model('Sexo');
            $this->load->model('Domicilio');
            $this->load->model('Wtipo_telefono');

            $data['estado_civil'] = new Estado_civil();
            $data['estado_civil']->get();
            $data['sexo'] = new Sexo();
            $data['sexo'] = $data['sexo']->get()->all_to_array();
            $sql = new Country();
            $data['nacionalidad'] = $sql->get()->all_to_array();
            $data['country'] = $sql->get()->all_to_array();
            $sql = new Establecimiento();

            $data['establecimiento'] = $sql->get()->all_to_array();
            $sql = new Widentificacion();
            $data['identificacion'] = $sql->get()->all_to_array();
            $sql = new State();
            $data['provincia'] = $sql->get()->all_to_array();
            $sql = new Localidad();
            $data['localidad'] = $sql->get()->all_to_array();
            $sql = new Wtipo_telefono();
            $data['telefono'] = $sql->get()->all_to_array();
            $a = new Alumno();
            $a->where('persona_id', $id)->include_all_related()->get();
            $data['cursos'] = $a->cursos;
            $data['alumno'] = $a;


            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('alumno/modify', $data);
                $this->load->view('templates/footer');
            } else {
                $a = $this->save_data();

                redirect("alumnos/alumno_data/" . $a->persona->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function save_data() {

        $a = new Alumno();
        $p = new Persona();
        $id = -1;
        if (isset($_POST['id_persona'])) {
            $p->where('id', $_POST['id_persona'])->get();
            $p->domicilio->delete_all();
            $p->persona_identificacion->delete_all();
            $p->telefono->delete_all();
            $a->where('persona_id', $_POST['id_persona'])->get();
            $id = $p->id;
        }
        $p = $this->personalibrary->save_data($id);
        $a->establecimiento_id = $_SESSION['establecimiento_id'];
        $a->save($p);
        return $a;
    }

    public function alumno_data($id) {
        if(parent::in_group(array("secretaria","professor"))) {

            $this->load->helper('url');
            $a = new Alumno();
            $a->where('persona_id', $id)->include_all_related()->get();

            $data = $this->personalibrary->get_create_view_data();
            $data['alumno'] = $a;
            $data['cursos'] = $a->cursos->order_by('id_ciclo_lectivo');
            $this->load->view('templates/header');
            $this->parser->parse('alumno/datos_alumno', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function add_related_view() {
        if(parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Widentificacion');
            $sql = new Widentificacion();
            $data['identificacion'] = $sql->get();

            if ($this->input->post('busqueda') == 'si') {
                $identificacion = new Persona_identificacion();
                if ($this->input->post('cd_identificacion') <> "")
                    $identificacion->where('widentificacion_id', $this->input->post('cd_identificacion'));
                if ($this->input->post('numero_identificacion') <> "")
                    $identificacion->like('numero_identificacion', $this->input->post('numero_identificacion'));
                $identificacion->get();
                $p = new Persona();
                if ($this->input->post('apellidos') <> "")
                    $p->like('apellidos', $this->input->post('apellidos'));
                if ($this->input->post('nombres') <> "")
                    $p->like('nombres', $this->input->post('nombres'));
                $p->where_related('persona_identificacion', 'id', $identificacion);
//            $p->get();
                $p->order_by("apellidos,nombres")->limit(10, (($_POST["page"] * 10)) - 10)->get();
                $data['personas'] = $p;
                $data['total'] = $p->count();

                $data['last_page'] = $data['total'] / 10;
                $data['page'] = $_POST["page"];
                $data['cd_identificacion'] = $this->input->post('cd_identificacion');
                $data['numero_identificacion'] = $this->input->post('numero_identificacion');
                $data['apellidos'] = $this->input->post('apellidos');
                $data['nombres'] = $this->input->post('nombres');
            }
            $this->load->view('templates/header');
            $this->load->view('alumno/add_familiar', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function add_related($id) {
        if(parent::in_group("secretaria")) {

            $a = new Persona();
            $a->where('id', $id)->get();
            $p = new Persona();
            $p->where('id', $this->input->post('persona_id'))->get();

            $vinculo = new Persona_familiar();
            if ($this->input->post('autorizado') == 'on')
                $vinculo->autorizado = 1;
            else
                $vinculo->autorizado = 0;
            $vinculo->parentesco = $this->input->post('parentesco');
            $vinculo->save(array('persona' => $a, 'pariente' => $p));
            $this->alumno_data($id);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_related() {
        if(parent::in_group("secretaria")) {

            $vinculo = new Persona_familiar();
            $vinculo->where('id', $_POST['vinculo_id'])->get();
            $vinculo->delete();
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function edit_relative() {
        if(parent::in_group("secretaria")) {

            $vinculo = new Persona_familiar();
            $vinculo->where('id', $_POST['vinculo_id'])->get();
            $vinculo->parentesco = $_POST['parentesco'];
            $vinculo->autorizado = $_POST['autorizado'] == 'true';
            $data[0] = $vinculo->parentesco;
            $data[1] = ($vinculo->autorizado) ? 'Si' : 'No';
            $vinculo->save();
            echo json_encode($data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function buscar() {
        if(parent::in_group(array("secretaria","professor"))) {

            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Widentificacion');
            $sql = new Widentificacion();
            $data['identificacion'] = $sql->get();
            $sql = new Establecimiento();
            $data['establecimiento'] = $sql->get()->all_to_array();
            if ($this->input->post('busqueda') == 'si') {
                $a = new Alumno();
                if ($_POST['vigente'] != "")
                    $a->where("vigente", $_POST['vigente']);
                if (!isset($_POST["establecimiento"])) {
                    $a->where_related("establecimiento", 'id', $_SESSION['establecimiento_id']);
                } else {
                    if ($_POST["establecimiento"] != 0) {
                        $a->where_related("establecimiento", 'id', $_POST['establecimiento']);
                    }
                }

                if ($this->input->post('apellidos') <> "")
                    $a->like_related("persona", 'apellidos', $this->input->post('apellidos'));
                if ($this->input->post('nombres') <> "")
                    $a->like_related("persona", 'nombres', $this->input->post('nombres'));
//            if (($this->input->post('cd_identificacion') <> "") || ($this->input->post('numero_identificacion') <> "")){
//                $identificacion = new Persona_identificacion();
                if ($this->input->post('numero_identificacion') <> "")
                    $a->like_related("persona/persona_identificacions", 'numero_identificacion', $this->input->post('numero_identificacion'));
//                    $identificacion->where('widentificacion_id', $this->input->post('cd_identificacion'));
                if ($this->input->post('cd_identificacion') <> "")
                    $a->like_related("persona/persona_identificacions", 'widentificacion_id', $this->input->post('cd_identificacion'));
//                $identificacion->get();
//                $p = new Persona();
//                $p->select('id')->where_related("persona_identificacion","id",$identificacion);
//                $a->where_in_subquery("persona_id", $p);
//            }

                $a->order_by_related("persona", "apellidos,nombres")->limit(10, (($_POST["page"] * 10)) - 10)->get();
                $data['alumnos'] = $a;
                $data['total'] = $a->count();
            }
            $data['last_page'] = $data['total'] / 10;
            $data['page'] = $_POST["page"];
            $data['parametros'] = $_POST;
            $this->load->view('templates/header');
            $this->parser->parse('alumno/buscar', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function update_parent($p) {
        $this->load->helper('url');
        $persona = new Persona();
        $persona->where('id', $p)->get();
        $data['persona'] = $persona;

        $this->load->view('templates/header');
        $this->load->view('alumno/update_parent', $data);
        $this->load->view('templates/footer');
    }

    public function alumno_exists($cd_identificacion, $nu_identificacion, $id_persona) {
        echo $this->personalibrary->person_exists($cd_identificacion, $nu_identificacion, $id_persona);
    }

    public function change_state() {
        $a = new Alumno();
        $a->where('id', $_POST['alumno_id']);
        $a->get();

        $av = new Alumno_vigencia();
        $av->estado = !$a->vigente;
        $av->fecha = $_POST["fecha"];
        $av->save(array($a));

        $a->vigente = !$a->vigente;
        $a->save();
    }

    public function update_states() {
        for ($i = 1; $i < 548; $i++) {
            $a = new Alumno();
            $a->where('id', $i);
            $a->get();
            $av = new Alumno_vigencia();
            $av->estado = 1;
            $av->fecha = date('Y-m-d');
            $av->save(array($a));
        }
    }

    public function get_existing_persons() {
        $persona = new Persona();
        $persona = $persona->like("nombres", $_POST['nombres'])->like("apellidos", $_POST['apellidos'])->where_related("persona_identificacion", "widentificacion_id", $_POST['cd_identificacion'])->like_related("persona_identificacion", 'numero_identificacion', $_POST['ds_identificacion'])->get()->all_to_array();
        echo json_encode($persona);
    }

}

?>
