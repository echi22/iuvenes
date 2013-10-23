<?php

include_once 'controlador.php';

class Cursos extends Controlador {

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
        if (parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_ciclo_lectivo', 'Ciclo Lectivo', 'required');
            $ley = new Ley_educacion();
            $leyes = $ley->get_all_vigentes();
            $data["anios_niveles"] = array();
            foreach ($leyes as $ley) {
                foreach ($ley->nivel_educativos->get() as $nivel_educativo) {
                    foreach ($nivel_educativo->anio_nivels->get() as $anio) {
                        $data["anios_niveles"][] = array("id" => $anio->id, "detalle" => $anio->detalle());
                    }
                }
            }
            $data['años_cursos'] = new Curso();
            $data['años_cursos'] = $data['años_cursos']->get_all_cursos_years();
            $data['curso'] = new Curso();
            $data['curso'] = $data['curso']->get()->all_to_array();
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('curso/create', $data);
                $this->load->view('templates/footer');
            } else {
                $c = new Curso();
                $c->from_array($_POST, '', false);
                $an = new Anio_nivel();
                $an->where(id, $_POST['anio_nivel'])->get();
                $c->establecimiento_id = $_SESSION['establecimiento_id'];
                $c->save($an);
                $this->generate_schedule($c);
                foreach ($_POST['alumnos_seleccionados'] as $alumno) {
                    echo $alumno;
                    $a = new Alumno();
                    $a->where('id', $alumno)->get();
                    $c->save($a);
                }
                redirect("cursos/curso_data/" . $c->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function generate_schedule($c) {

        $h = new Hora();
        $h->get();
        foreach ($h as $hora) {
            $horario = new Horario();
            $horario->save(array($hora, $c));
        }
    }

    public function save_alumnos($id) {
        if (parent::in_group("secretaria")) {
            $this->load->helper('url');
            $c = new Curso();
            $c->where('id', $id)->get();
            foreach ($_POST['alumnos_seleccionados'] as $alumno) {
                $a = new Alumno();
                $a->where('id', $alumno)->get();
                $c->save($a);
            }
            redirect("cursos/curso_data/" . $c->id);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function save_prestaciones($id) {
        if (parent::in_group("secretaria")) {
            $this->load->helper('url');
            $c = new Curso();
            $c->where('id', $id)->get();
            foreach ($_POST['prestaciones_seleccionadas'] as $prestacion) {
                $p = new Prestacion();
                $p->where('id', $prestacion)->get();
                $c->save($p);
            }
            redirect("cursos/curso_data/" . $c->id);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_alumno() {
        if (parent::in_group("secretaria")) {
            $c = new Curso();
            $c->where('id', $_POST['curso_id'])->get();
            $a = new Alumno();
            $a->where('id', $_POST['alumno_id'])->get();
            $c->delete($a);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_prestacion() {
        if (parent::in_group("secretaria")) {
            $c = new Curso();
            $c->where('id', $_POST['curso_id'])->get();
            $p = new Prestacion();
            $p->where('id', $_POST['prestacion_id'])->get();
            $c->delete($p);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function modify($id) {
        if (parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_ciclo_lectivo', 'Ciclo Lectivo', 'required');
            $ley = new Ley_educacion();
            $leyes = $ley->get_all_vigentes();
            $data["anios_niveles"] = array();
            foreach ($leyes as $ley) {
                foreach ($ley->nivel_educativos->get() as $nivel_educativo) {
                    foreach ($nivel_educativo->anio_nivels->get() as $anio) {
                        $data["anios_niveles"][] = array("id" => $anio->id, "detalle" => $anio->detalle());
                    }
                }
            }
            $data['años_cursos'] = new Curso();
            $data['años_cursos'] = $data['años_cursos']->get_all_cursos_years();
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
                $an = new Anio_nivel();
                $an->where(id, $_POST['anio_nivel'])->get();
                $c->establecimiento_id = $_SESSION['establecimiento_id'];
                $c->save(array($an));
                redirect("cursos/curso_data/" . $c->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    function get_cursos_by_year() {
        $c = new Curso();
        $c->where('id_ciclo_lectivo', $_POST['id_ciclo_lectivo'])->where('establecimiento_id', $_SESSION['establecimiento_id'])->get();
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
        ini_set('memory_limit', '-1');
        $c = new Curso();
        if ($_POST['id'] == "") {
            if ($_POST['anio_cursos'] == "Todos") {
                $get_alumnos = new Alumno();
                $subq = new Alumno();
                $subq->select('id')->where_related('curso', 'id', $_POST['current_curso']);
                $subq2 = new Persona();
                $subq2->select('id')->like("apellidos", $_POST['filtro'])->or_like("nombres", $_POST['filtro'])->or_like_related("persona_identificacion", "numero_identificacion", $_POST['filtro']);
                $alumnos = $get_alumnos->include_all_related()->where_not_in_subquery('persona_id', $subq)->where_in_subquery("id", $subq2)->where('establecimiento_id', $_SESSION['establecimiento_id'])->order_by('persona_apellidos', 'persona_nombres')->get();
            } else {
                $subq2 = new Persona();
                $subq2->select('id')->like("apellidos", $_POST['filtro'])->or_like("nombres", $_POST['filtro'])->or_like_related("persona_identificacion", "numero_identificacion", $_POST['filtro']);
                $c->where('id_ciclo_lectivo', $_POST['anio_cursos'])->where('establecimiento_id', $_SESSION['establecimiento_id'])->where('id !=', $_POST[current_curso])->get();
                $a = new Alumno();
                $alumnos = $a->include_all_related()->where_related('curso', 'id', $c->id)->where_in_subquery('id', $subq2)->order_by('persona_apellidos', 'persona_nombres')->get();
            }
        } else {
            $c->where('id', $_POST['id'])->get();
            $subq2 = new Persona();
            $subq2->select('id')->like("apellidos", $_POST['filtro'])->or_like("nombres", $_POST['filtro'])->or_like_related("persona_identificacion", "numero_identificacion", $_POST['filtro']);

            $a = new Alumno();
            $alumnos = $a->include_all_related()->where_related('curso', 'id', $c->id)->where_in_subquery('id', $subq2)->order_by('persona_apellidos', 'persona_nombres')->get();
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

    function get_alumnos_from_ciclo_lectivo() {

        ini_set('memory_limit', '-1');
        $c = new Curso();
        $c->select("id")->where("id !=", -1)->get();

        $current_curso = new Curso();
        $current_curso->where('id', $_POST['current_curso'])->get();
        $a = new Aspirante();
        $a->select("persona_id")->where("ciclo_lectivo", $current_curso->id_ciclo_lectivo)->where("anio_nivel", $current_curso->anio_nivel_id)->where("estado", 4);
        $sub_al = new Alumno();
        $sub_al->select('id')->where_related_curso("id", $c);
        $alumnos = new Alumno();
        $alumnos->where_in_subquery('persona_id', $a)->where_not_in_subquery("id", $sub_al)->get();
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
        $subq2 = new Persona();
        $subq2->select('id')->like("apellidos", $_POST['filtro'])->or_like("nombres", $_POST['filtro'])->or_like_related("persona_identificacion", "numero_identificacion", $_POST['filtro']);
        $subq = new Personal();
        $subq->select('id')->where_in_subquery('persona_id', $subq2);
        $prestaciones = new Prestacion();
        $not_related = new Prestacion();
        $not_related->select('id')->where_related("curso", 'id', $_POST['curso_id']);
        $prestaciones->where_in_subquery("personal_id", $subq)->where_not_in_subquery('id', $not_related)->get();
        $result = array();
        foreach ($prestaciones as $prestacion) {
            if ($prestacion->personal->establecimiento_id == $_SESSION['establecimiento_id']) {
                $p = array();
                $p['detalle'] = $prestacion->detalle();
                $p['id'] = $prestacion->id;
                array_push($result, $p);
            }
        }
        echo json_encode($result);
    }

    public function curso_data($id) {
        if (parent::in_group(array("secretaria", "professor"))) {
            $this->load->helper('url');
            $c = new Curso();
            $c->where('id', $id)->include_all_related()->get();
            $data = $this->cursolibrary->get_create_view_data();
            $data['curso'] = $c;
            $data["anios_niveles"] = array();
            $ley = new Ley_educacion();
            $leyes = $ley->get_all_vigentes();
            foreach ($leyes as $ley) {
                foreach ($ley->nivel_educativos->get() as $nivel_educativo) {
                    foreach ($nivel_educativo->anio_nivels->get() as $anio) {
                        $data["anios_niveles"][] = array("id" => $anio->id, "detalle" => $anio->detalle());
                    }
                }
            }
            $h = new Hora();
            $h->get();
            $data['horas'] = $h;
            $this->load->view('templates/header');
            $this->parser->parse('curso/datos_curso', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function alumnos($id) {
        $this->load->helper('form');
        $this->load->helper('url');
        $data['años_cursos'] = new Curso();
        $data['años_cursos'] = $data['años_cursos']->get_all_cursos_years();
        $data['all_cursos'] = new Curso();
        $data['all_cursos'] = $data['all_cursos']->get()->all_to_array();
        $data['curso'] = new Curso();
        $data['curso'] = $data['curso']->where('id', $id)->get();
        $this->load->view('templates/header');
        $this->parser->parse('curso/alumnos', $data);
        $this->load->view('templates/footer');
    }

    public function buscar() {
        if (parent::in_group(array("secretaria", "professor"))) {
            $this->load->helper('form');
            $this->load->helper('url');
            $data['orientacion'] = new Orientation();
            $data['orientacion'] = $data['orientacion']->get()->all_to_array();
            $data['nivel_educativo'] = new Nivel_educativo();
            $data['nivel_educativo'] = $data['nivel_educativo']->get()->all_to_array();
            if ($this->input->post('busqueda') == 'si') {
                $c = new Curso();
                if ($_POST['id_ciclo_lectivo'] != "")
                    $c->where('id_ciclo_lectivo', $_POST['id_ciclo_lectivo']);
                if ($_POST['year'] != "")
                    $c->where_related('anio_nivel', 'ds_anio', $_POST['year']);
                if ($_POST['nivel'] != "")
                    $c->where_related('anio_nivel', 'nivel_educativo_id', $_POST['nivel']);
                if ($_POST['orientacion'] != "")
                    $c->where_related('anio_nivel', 'orientation_id', $_POST['orientacion']);
                if ($_POST['cd_turno'] != "")
                    $c->where('cd_turno', $_POST['cd_turno']);
                if ($_POST['ds_seccion'] != "")
                    $c->where('ds_seccion', $_POST['ds_seccion']);
                $c->where_related("establecimiento", 'id', $_SESSION['establecimiento_id']);
                $c->get();

                $data['cursos'] = $c;
            }
            $data['parametros'] = $_POST;
            $this->load->view('templates/header');
            $this->parser->parse('curso/buscar', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    function save_horarios() {
        if (parent::in_group("secretaria")) {
            $t = new ScheduleTable();
            $t->where('curso_id', $_POST['curso_id'])->get();
            $t->delete();
            $t = new ScheduleTable();
            $t->html = $_POST['table'];
            $c = new Curso();
            $c->where('id', $_POST['curso_id'])->get();

            $t->save($c);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    function check_professor_free(){
         if (parent::in_group("secretaria")) {
           $libre = true;  
           $hora = explode("_",$_POST['hora_id']);
           $dia = $hora[0];
           $hora = $hora[1];
           $cpp = new Materium_curso_prestacion_personal();
           $cpp->where("curso_id",$_POST['curso_id'])->where("materium_id",$_POST['materia_id'])->get();
           $p = new Personal();
           $p = $cpp->prestacion->personal;
           $c = new Curso();
           $c = $cpp->curso;           
           $materias = new Materium_curso_prestacion_personal();
           $materias->where_related('prestacion','personal_id',$p->id)->where_related('curso','id_ciclo_lectivo',$c->id_ciclo_lectivo)->get();
           foreach ($materias as $materia) {
               $h = new Horario();
               $h->where("curso_id",$materia->curso_id)->where("curso_id !=",$_POST['curso_id'])->where("hora_id",$hora)->get();
               foreach ($h as $horario) {
                   $horario = array($horario);
                   if($horario[0]->$dia== $materia->materium_id){
                       $libre = false;
                       $curso = new Curso();
                       $curso->where('id',$materia->curso_id)->get();
                       $errorMessage = "El profesor ya dicta clases en este horario en el curso ".$curso->detalle();
                       break;
                   }
               }
               if(!$libre)
                   break;
           }
           if($libre){
               echo "true";
           }else{
              echo json_encode($errorMessage);
           }
        } else {
         $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
         redirect("users/error");
        }
    }
    
    
    function save_horarios_modifications() {
        if (parent::in_group("secretaria")) {
           $horarios = json_decode($_POST['horarios']);
           foreach ($horarios as $key=>$materia) {
               $h = new Horario();
               $key = explode("_", $key);
               $horario_id = $key[1];
               $dia = $key[0];
               $h->where('curso_id',$_POST['curso_id'])->where('hora_id',$horario_id)->get();
               $m = new Materium();               
               $h->$dia = $materia;
               $h->save();
           }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    function generate_automatically(){
        
         $this->load->view('templates/header');
                $this->parser->parse('curso/create_automatically', $data);
                $this->load->view('templates/footer');
                
    }
    function generate_cursos_automatically(){
        $c= new Curso();
        $c->where('id_ciclo_lectivo',$_POST['id_ciclo_lectivo'])->where('establecimiento_id',$_SESSION['establecimiento_id'])->get();
        foreach ($c as $curso) {
            $newCurso = $curso->get_copy();
            $newCurso->id_ciclo_lectivo = $newCurso->id_ciclo_lectivo +1;            
            $newCurso->save($curso->anio_nivel);
            
            foreach ($curso->prestacions as $prestacion) {
                $newCurso->save($prestacion);
            }
            foreach ($curso->materium_curso_prestacion_personals as $mcpp) {
                $newMcpp = $mcpp->get_copy();
                $newMcpp->curso_id = $newCurso->id;
                $newMcpp->save();
            }
            foreach ($curso->horarios as $hora){                
                $newHorario = $hora->get_copy();
                $newHorario->curso_id = $newCurso->id;
                $newHorario->save();
            }
            $curso_anterior = $newCurso->get_previous_curso();
            if($curso_anterior != null){
                foreach ($curso_anterior->alumnos as $alumno) {
                    $newCurso->save($alumno);
                }
            }
        }
    }
    function save_materias_docentes() {
        if (parent::in_group("secretaria")) {
            $data = json_decode($_POST[data]);
            $result = array();
            for ($i = 0; $i < count($data->materias); $i++) {
                $m = new Materium();
                $m->where('id', $data->materias[$i])->get();
                $c = new Curso();
                $c->where('id', $_POST['curso_id'])->get();
                $p = new Prestacion();
                $p->where('id', $data->docentes[$i])->get();

                $s = new Prestacion();
                $s->where('id', $data->suplente[$i])->get();
                $mcp = new Materium_curso_prestacion_personal();
                $mcp->where('materium_id', $data->materias[$i])->where('curso_id', $_POST['curso_id'])->get();
                $mcp->delete();
                if ($data->docentes[$i] != "-") {
                    $result[str_replace(' ', '', $m->nombre) . "_" . $m->id] = $p->isSuplente();
                    $mcp = new Materium_curso_prestacion_personal();
                    $mcp->vigente = 1;
                    $mcp->save(array($c, $m, $p));

                    if ($data->suplentes[$i] != "-")
                        $mcp->save_suplente_de($s);
                }
            }
            echo json_encode($result);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

}

?>
