<?php

class Cursos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->model('orientation');
        $this->load->model('nivel_educativo');
        $this->load->model('anio_nivel');
        $this->load->model('alumno');
        $this->load->library('cursolibrary');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_ciclo_lectivo', 'Ciclo Lectivo', 'required');
        $data['orientacion'] = new Orientation();
        $data['orientacion'] = $data['orientacion']->get()->all_to_array();
        $data['nivel_educativo'] = new Nivel_educativo();
        $data['nivel_educativo'] = $data['nivel_educativo']->get()->all_to_array();
        $data['años_cursos'] = new Curso();
        $data['años_cursos'] = $data['años_cursos']->get_all_cursos_years();
        array_unshift($data['años_cursos'], $data['años_cursos'][0]);
        $data['años_cursos'][0]['id_ciclo_lectivo'] = 'Todos';
        $data['curso'] = new Curso();
        $data['curso'] = $data['curso']->get()->all_to_array();
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->parser->parse('curso/create', $data);
            $this->load->view('templates/footer');
        } else {
            $c = new Curso();
            $c->from_array($_POST, '', false);
            $o = new Orientation();
            $o->where(id, $_POST['orientacion'])->get();
            $ne = new Nivel_educativo();
            $ne->where(id, $_POST['nivel'])->get();
            $an = new Anio_nivel();
            $an->ds_anio = $_POST['year'];
            $an->save(array($o, $ne));
            $c->establecimiento_id = 1;
            $c->save(array($an));
            foreach ($_POST['alumnos_seleccionados'] as $alumno) {
                echo $alumno;
                $a = new Alumno();
                $a->where('id', $alumno)->get();
                $c->save($a);
            }
            redirect("cursos/curso_data/" . $c->id);
        }
    }

    function get_cursos_by_year() {
        $c = new Curso();
        $c->where('id_ciclo_lectivo', $_POST['id_ciclo_lectivo'])->get();
        $result = array();

        foreach ($c as $curso) {
            $city = array();
            $city['name'] = $curso->detalle();
            $city['id'] = $curso->id;
            array_push($result, $city);
        }
        echo json_encode($result);
    }

    function get_alumnos_from_curso() {
        $c = new Curso();
        if ($_POST['id'] == "") {
            $get_alumnos = new Alumno();
            $alumnos = $get_alumnos->include_all_related()->order_by('persona_apellidos', 'persona_nombres')->get();
        } else {
            $c->where('id', $_POST['id'])->get();
            $c->alumno->include_all_related()->order_by('persona_apellidos', 'persona_nombres')->get();
            $alumnos = $c->alumno;
        }

        $result = array();

        foreach ($alumnos as $alumno) {
            $a = array();
            $a['detalle'] = $alumno->detalle();
            $a['id'] = $alumno->id;
            array_push($result, $a);
        }
        echo json_encode($result);
    }

    public function curso_data($id) {
        $this->load->helper('url');
        $c = new Curso();
        $c->where('id', $id)->get();
        $data = $this->cursolibrary->get_create_view_data();
        $data['curso'] = $c;

        $this->load->view('templates/header');
        $this->parser->parse('cursos/datos_curso', $data);
        $this->load->view('templates/footer');
    }

}

?>
