<?php

include_once 'controlador.php';

class Plan_estudios extends Controlador {

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
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/create', $data);
            $this->load->view('templates/footer');
        }
    }

    public function show_ley_educacion() {
        $ley = new Ley_educacion();
        $data["ley"] = $ley->get();
        $this->load->view('templates/header');
        $this->parser->parse('plan_estudio/show_ley_educacion', $data);
        $this->load->view('templates/footer');
    }

    public function edit_ley_educacion() {
        $l = new Ley_educacion();
        $l->where('id', $_POST['id'])->get();
        $l->ds_ley = $_POST['ds_ley'];
        $l->dt_ini_vig = $_POST['dt_ini_vig'];
        $l->dt_fin_vig = $_POST['dt_fin_vig'];
        $l->in_vigente = $_POST['in_vigente'];
        $l->save();
        echo json_encode($l);
    }

    public function delete_ley_educacion() {
        $l = new Ley_educacion();
        $l->where("id", $_POST['id'])->get();
        $l->delete();
    }

    public function add_orientation() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ds_orientation', 'Nombre', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_orientation', $data);
            $this->load->view('templates/footer');
        } else {
            $o = new Orientation();
            $o->ds_orientacion = $_POST['ds_orientation'];
            $o->save();
            redirect("/plan_estudios/show_orientation");
        }
    }

    public function show_orientation() {
        $o = new Orientation();
        $data["orientation"] = $o->get();
        $this->load->view('templates/header');
        $this->parser->parse('plan_estudio/show_orientation', $data);
        $this->load->view('templates/footer');
    }

    public function edit_orientation() {
        $o = new Orientation();
        $o->where('id', $_POST['id'])->get();
        $o->ds_orientacion = $_POST['orientation'];
        $o->save();
        echo json_encode($o);
    }

    public function delete_orientation() {
        $o = new Orientation();
        $o->where("id", $_POST['id'])->get();
        $o->delete();
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
            $ne->save($l);
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_nivel_educativo', $data);
            $this->load->view('templates/footer');
        }
    }

    public function show_nivel_educativo() {
        $nivel = new Nivel_educativo();
        $data["nivel_educativo"] = $nivel->get();
        $ley = new Ley_educacion();
        $data["ley"] = $ley->get()->all_to_array();
        $this->load->view('templates/header');
        $this->parser->parse('plan_estudio/show_nivel_educativo', $data);
        $this->load->view('templates/footer');
    }

    public function edit_nivel_educativo() {
        $n = new Nivel_educativo();
        $n->where('id', $_POST['id'])->include_related('ley_educacion')->get();
        $n->ley_educacion_id = $_POST['ley'];
        $n->ds_nivel = $_POST['nivel'];
        $n->dt_ini_vig = $_POST['dt_ini_vig'];
        $n->dt_fin_fic = $_POST['dt_fin_fic'];
        $n->in_vigente = $_POST['in_vigente'];
        $n->save();
        //Es necesario recuperar el objeto de nuevo porque si no no se actualiza la ley
        $nivel = new Nivel_educativo();
        $nivel->where('id', $_POST['id'])->include_related('ley_educacion')->get();
        //esta linea es necesaria para que devuelva la ley con toda su información.
        $a = $nivel->ley_educacion->id;
        echo json_encode($nivel);
    }

    public function delete_nivel_educativo() {
        $n = new Nivel_educativo();
        $n->where("id", $_POST['id'])->get();
        $n->delete();
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
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_anio_nivel', $data);
            $this->load->view('templates/footer');
        }
    }

    public function show_anio_nivel() {
        $nivel = new Anio_nivel();
        $data["anio_nivel"] = $nivel->get();
        $o = new Orientation();
        $data["orientation"] = $o->get()->all_to_array();
        $ne = new Nivel_educativo();
        $data["nivel_educativo"] = $ne->get()->all_to_array();
        $this->load->view('templates/header');
        $this->parser->parse('plan_estudio/show_anio_nivel', $data);
        $this->load->view('templates/footer');
    }

    public function edit_anio_nivel() {
        $an = new Anio_nivel();
        $an->where('id', $_POST['id'])->include_all_related()->get();
        $an->nivel_educativo_id = $_POST['nivel'];
        $an->ds_anio = $_POST['anio'];
        $an->orientation_id = $_POST['orientacion'];       
        $an->save();
        //Es necesario recuperar el objeto de nuevo porque si no no se actualiza la ley
        $anio_nivel = new Anio_nivel();
        $anio_nivel->where('id', $_POST['id'])->include_all_related()->get();
        //esta linea es necesaria para que devuelva la ley con toda su información.
        $a = $anio_nivel->orientation->id;
        $a = $anio_nivel->nivel_educativo->id;
        echo json_encode($anio_nivel);
    }

    public function delete_anio_nivel() {
        $n = new Anio_nivel();
        $n->where("id", $_POST['id'])->get();
        $n->delete();
    }

    function add_materia() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nueva_materia', 'Nombre', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('plan_estudio/add_materia', $data);
            $this->load->view('templates/footer');
        } else {
            $m = new Materium();
            $m->nombre = $_POST["nueva_materia"];
            $m->color = $_POST["color"];
            $m->save();
            redirect("/plan_estudios/show_materium");
        }
    }

    function check_available_color() {
        $m = new Materium();
        $m->where("color", $_POST['color'])->get();
        if (count($m->all_to_array()) > 0)
            echo false;
        else
            echo true;
    }

    public function show_materium() {
        $m = new Materium();
        $data["materias"] = $m->get();
        $this->load->view('templates/header');
        $this->parser->parse('plan_estudio/show_materium', $data);
        $this->load->view('templates/footer');
    }

    public function edit_materium() {
        $m = new Materium();
        $m->where('id', $_POST['id'])->get();
        $m->nombre = $_POST['nombre'];
        $m->color = $_POST['color'];
        $m->save();
        echo json_encode($m);
    }

    public function delete_materium() {
        $m = new Materium();
        $m->where("id", $_POST['id'])->get();
        $m->delete();
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
        }
    }

    function add_materias_to_anio_nivel() {
        foreach ($_POST['niveles'] as $nivel) {
            $n = new Anio_nivel();
            $n->where('id', $nivel)->get();
            foreach ($_POST['materias'] as $materia) {
                $m = new Materium();
                $m->where('id', $materia)->get();
                $n->save($m);
            }
        }
    }

}

?>
