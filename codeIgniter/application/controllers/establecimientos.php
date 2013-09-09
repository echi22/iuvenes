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
            redirect("establecimientos/listado");
        }
    }

    public function work_here() {
        $id = $_SESSION['user_id'];
        $data = array('establecimiento_id' => $_POST['establecimiento_id']);
        $this->ion_auth->update($id, $data);
              
        $_SESSION['user'] = $this->ion_auth->user()->row();
        if ($_POST['establecimiento_id'] != 0){
            $e = new Establecimiento();
            $e->where('id',$_SESSION['user']->establecimiento_id)->get();
            $_SESSION['establecimiento'] = $e->ds_establecimiento;
            
        }else
            $_SESSION['establecimiento'] = "Visión global";

        $_SESSION['establecimiento_id'] = $_SESSION['user']->establecimiento_id;

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
