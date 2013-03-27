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
        $this->load->model('scheduletable');
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

    public function save_alumnos($id) {
        $this->load->helper('url');
        $c = new Curso();
        $c->where('id', $id)->get();
        foreach ($_POST['alumnos_seleccionados'] as $alumno) {
            $a = new Alumno();
            $a->where('id', $alumno)->get();
            $c->save($a);
        }
        redirect("cursos/curso_data/" . $c->id);
    }

    public function save_prestaciones($id) {
        $this->load->helper('url');
        $c = new Curso();
        $c->where('id', $id)->get();
        foreach ($_POST['prestaciones_seleccionadas'] as $prestacion) {
            $p = new Prestacion();
            $p->where('id', $prestacion)->get();
            $c->save($p);
        }
        redirect("cursos/curso_data/" . $c->id);
    }

    public function delete_alumno() {
        $c = new Curso();
        $c->where('id', $_POST['curso_id'])->get();
        $a = new Alumno();
        $a->where('id', $_POST['alumno_id'])->get();
        $c->delete($a);
    }

    public function delete_prestacion() {
        $c = new Curso();
        $c->where('id', $_POST['curso_id'])->get();
        $p = new Prestacion();
        $p->where('id', $_POST['prestacion_id'])->get();
        $c->delete($p);
    }

    public function modify($id) {
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
            $this->parser->parse('alumno/modify', $data);
            $this->load->view('templates/footer');
        } else {
            $c = new Curso();
            $c->where('id', $id)->get();
            $c->from_array($_POST, '', false);
            $o = new Orientation();
            $o->where(id, $_POST['orientacion'])->get();
            $ne = new Nivel_educativo();
            $ne->where(id, $_POST['nivel'])->get();
            $an = new Anio_nivel();
            $an->where('id', $c->anio_nivel->id)->get();
            $an->ds_anio = $_POST['year'];
            $an->save(array($o, $ne));
            $c->establecimiento_id = 1;
            $c->save(array($an));
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
            if ($_POST['anio_cursos'] == "Todos") {
                $get_alumnos = new Alumno();
                $subq = new Alumno();
                $subq->select('id')->where_related('curso', 'id', $_POST['current_curso']);
                $alumnos = $get_alumnos->include_all_related()->where_not_in_subquery('id', $subq)->order_by('persona_apellidos', 'persona_nombres')->get();
            } else {
                $c->where('id_ciclo_lectivo', $_POST['anio_cursos'])->where('id !=', $_POST[current_curso])->get();
                $c->alumno->include_all_related()->order_by('persona_apellidos', 'persona_nombres')->get();
                $alumnos = $c->alumno;
            }
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

    public function get_prestaciones() {
        $prestaciones = new Prestacion();
        $prestaciones->where_related('curso', 'id !=', $_POST["id_curso"])->get();
        $result = array();
        foreach ($prestaciones as $prestacion) {
            $p = array();
            $p['detalle'] = $prestacion->detalle();
            $p['id'] = $prestacion->id;
            array_push($result, $p);
        }
        echo json_encode($result);
    }

    public function curso_data($id) {
        $this->load->helper('url');
        $c = new Curso();
        $c->where('id', $id)->include_all_related()->get();
        $data = $this->cursolibrary->get_create_view_data();
        $data['curso'] = $c;
        

        $this->load->view('templates/header');
        $this->parser->parse('curso/datos_curso', $data);
        $this->load->view('templates/footer');
    }

    public function alumnos($id) {
        $this->load->helper('form');
        $this->load->helper('url');
        $data['años_cursos'] = new Curso();
        $data['años_cursos'] = $data['años_cursos']->get_all_cursos_years();
        array_unshift($data['años_cursos'], $data['años_cursos'][0]);
        $data['años_cursos'][0]['id_ciclo_lectivo'] = 'Todos';
        $data['all_cursos'] = new Curso();
        $data['all_cursos'] = $data['all_cursos']->get()->all_to_array();
        $data['curso'] = new Curso();
        $data['curso'] = $data['curso']->where('id', $id)->get();
        $this->load->view('templates/header');
        $this->parser->parse('curso/alumnos', $data);
        $this->load->view('templates/footer');
    }

    public function buscar() {
        $this->load->helper('form');
        $this->load->helper('url');
        $data['orientacion'] = new Orientation();
        $data['orientacion'] = $data['orientacion']->get()->all_to_array();
        $data['nivel_educativo'] = new Nivel_educativo();
        $data['nivel_educativo'] = $data['nivel_educativo']->get()->all_to_array();    
        if ($this->input->post('busqueda') == 'si') {   
            $c = new Curso();
            if($_POST['id_ciclo_lectivo'] != "")
                $c->where('id_ciclo_lectivo',$_POST['id_ciclo_lectivo']);
            if($_POST['year'] != "")
                $c->where_related('anio_nivel','ds_anio',$_POST['year']);
            if($_POST['nivel'] != "")
                $c->where_related('anio_nivel','nivel_educativo_id',$_POST['nivel']);
            if($_POST['orientacion'] != "")
                $c->where_related('anio_nivel','orientation_id',$_POST['orientacion']);
            if($_POST['cd_turno'] != "")
                $c->where('cd_turno',$_POST['cd_turno']);
            if($_POST['ds_seccion'] != "")
                $c->where('ds_seccion',$_POST['ds_seccion']);
            $c->get();            
            $data['cursos'] = $c;
        }
        $this->load->view('templates/header');
        $this->parser->parse('curso/buscar', $data);
        $this->load->view('templates/footer');
    }
    function save_horarios(){
        $t = new ScheduleTable();
        $t->where('curso_id',$_POST['curso_id'])->get();
        $t->delete();
        $t = new ScheduleTable();
        $t->html = $_POST['table'];
        $c = new Curso();
        $c->where('id',$_POST['curso_id'])->get();
        
        $t->save($c);
    }
}

?>
