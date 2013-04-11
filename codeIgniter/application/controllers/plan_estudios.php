<?php

class Plan_estudios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ds_ley', 'Ley', 'required');
        $this->form_validation->set_rules('dt_ini_vig', 'Fecha de Inicio', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/create', $data);
            $this->load->view('templates/footer');
        } else {
            $l = new Ley_educacion();
            $l->in_vigente = 1;
            $l->from_array($_POST, "", true);
        }
    }

    public function add_nivel_educativo() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ds_nivel', 'Nivel Educativo', 'required');
        $data['ley'] = new Ley_educacion();
        $data['ley'] = $data['ley']->get()->all_to_array();
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_nivel_educativo', $data);
            $this->load->view('templates/footer');
        } else {
            $ne = new Nivel_educativo();
            $ne->ds_nivel = $_POST["ds_nivel"];
            $ne->in_vigente = 1;
            $l = new Ley_educacion();
            $l->where(id, $_POST["ley_educacion"])->get();
            echo $l->ds_ley;
            $ne->save($l);
        }
    }

    public function add_anio_nivel() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nivel', 'Nivel Educativo', 'required');
        $data['orientacion'] = new Orientation();
        $data['orientacion'] = $data['orientacion']->get()->all_to_array();
        $ley = new Ley_educacion();
        $leyes = $ley->get_all_vigentes();

        $data['nivel_educativo'] = array();
        foreach ($leyes as $ley) {
            $data["nivel_educativo"] = array_merge($data['nivel_educativo'], $ley->nivel_educativos->get()->all_to_array());
        }
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_anio_nivel', $data);
            $this->load->view('templates/footer');
        } else {
            $o = new Orientation();
            $o->where(id, $_POST['orientacion'])->get();
            $ne = new Nivel_educativo();
            $ne->where(id, $_POST['nivel'])->get();
            $an = new Anio_nivel();
            $an->ds_anio = $_POST['year'];
            $an->save(array($o, $ne));

            redirect("cursos/curso_data/" . $c->id);
        }
    }

    function add_materia_to_anio_nivel() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('anio_nivel', 'Nivel', 'required');
        $ley = new Ley_educacion();
        $leyes = $ley->get_all_vigentes();
        foreach ($leyes as $ley) {
            foreach ($ley->nivel_educativos->get() as $nivel_educativo) {
                foreach ($nivel_educativo->anio_nivels->get() as $anio) {
                    $data["anios_niveles"][] = array("id" => $anio->id, "detalle" => $anio->detalle());
                }
            }
        }
        $data["materias"] = new Materium();
        $data["materias"] = $data["materias"]->get()->all_to_array();
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_materia_to_anio_nivel', $data);
            $this->load->view('templates/footer');
        } else {
            $m = new Materium();
            if($_POST['nueva_materia'] != ""){
                $m->nombre = $_POST["nueva_materia"];
            }else{
                $m->where("id",$_POST["materia_selected"])->get();
            }                    
            $an = new Anio_nivel();
            $an->where("id", $_POST["anio_nivel"])->get();
            $m->save($an);
            redirect("cursos/curso_data/" . $c->id);
        }
    }

}

?>
