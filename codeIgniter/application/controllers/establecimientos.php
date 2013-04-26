<?php

include_once 'controlador.php';

class Establecimientos extends Controlador {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ds_establecimiento', 'Nombre', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('establecimiento/create', $data);
            $this->load->view('templates/footer');
        } else {
            $e = new Establecimiento();
            $e->from_array($_POST, "", true);
        }
    }

    public function work_here() {
        $u = new User();
        $u->where('id', $_SESSION['user_id'])->get();
        $u->establecimiento_id = $_POST['establecimiento_id'];
        $u->save();
        $_SESSION['user'] = $u;
        $_SESSION['establecimiento'] = $_SESSION['user']->establecimiento->ds_establecimiento;
        $_SESSION['establecimiento_id'] = $_SESSION['user']->establecimiento->id;

        echo $_SESSION['establecimiento'];
    }

    public function listado() {
        $this->load->helper('url');
        $data['establecimiento'] = new Establecimiento();
        $data['establecimiento']->where('vigente', 1)->get();
        $data['establecimiento']->all_to_array;
        $this->load->view('templates/header');
        $this->parser->parse('establecimiento/listado', $data);
        $this->load->view('templates/footer');
    }

    public function edit_establecimiento() {
        $e = new Establecimiento();
        $e->where('id', $_POST['establecimiento_id'])->get();
        $e->ds_establecimiento = $_POST['ds_establecimiento'];
        $e->save();
        echo json_encode($e);
    }

    public function delete_establecimiento() {
        $e = new Establecimiento();
        $e->where('id', $_POST['establecimiento_id'])->get();
        $e->vigente = 0;
        $e->save();
    }

    public function modify($establecimiento_id) {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ds_establecimiento', 'Nombre', 'required');
        $data['establecimiento'] = new Establecimiento();
        $data['establecimiento']->where('id', $establecimiento_id)->get();
        $data['establecimiento']->all_to_array;
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('establecimiento/modify', $data);
            $this->load->view('templates/footer');
        } else {
            $e = new Establecimiento();
            $e->from_array($_POST, "", true);
        }
    }

}

?>
