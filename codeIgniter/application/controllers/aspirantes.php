<?php

include_once 'controlador.php';

class Aspirantes extends Controlador {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->library('personalibrary');
        $this->load->model('anio_nivel');
        $this->load->model('ley_educacion');
    }

    public function create_aspirante() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $data = $this->personalibrary->get_create_view_data();
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
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('aspirante/create_aspirante', $data);
                $this->load->view('templates/footer');
            } else {
                $a = $this->save_aspirante_data();
                redirect("aspirantes/aspirante_data/" . $a->persona->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function aspirante_data($id) {
        if (parent::in_group("secretaria")) {

            $this->load->helper('url');
            $a = new Aspirante();
            $data = $this->personalibrary->get_create_view_data();
            $a->where('persona_id', $id)->include_all_related()->get();
            $ley = new Ley_educacion();
            $leyes = $ley->get_all_vigentes();
            $data["anios_niveles"] = array();
            $data['aspirante'] = $a;
            $data['aspirante'] = $a;
            foreach ($leyes as $ley) {
                foreach ($ley->nivel_educativos->get() as $nivel_educativo) {
                    foreach ($nivel_educativo->anio_nivels->get() as $anio) {
                        $data["anios_niveles"][] = array("id" => $anio->id, "detalle" => $anio->detalle());
                    }
                }
            }

            $this->load->view('templates/header');
            $this->parser->parse('aspirante/datos_aspirante', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function modify_aspirante($id) {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $data = $this->personalibrary->get_create_view_data();
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
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('aspirante/modify_aspirante', $data);
                $this->load->view('templates/footer');
            } else {
                $a = $this->save_aspirante_data();
                redirect("aspirantes/aspirante_data/" . $a->persona->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function save_aspirante_data() {
        if (parent::in_group("secretaria")) {

            $a = new Aspirante();
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
            $a->from_array($_POST, '', false);
            $p = $this->personalibrary->save_data($id);
            $a->estado = 1;
            $a->establecimiento_id = $_SESSION['establecimiento_id'];
            $a->save($p);
            return $a;
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function add_related_view() {
        if (parent::in_group("secretaria")) {

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
            $this->load->view('aspirante/add_familiar', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function add_related($id) {
        if (parent::in_group("secretaria")) {

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
            $this->aspirante_data($id);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_related() {
        if (parent::in_group("secretaria")) {

            $vinculo = new Persona_familiar();
            $vinculo->where('id', $_POST['vinculo_id'])->get();
            $vinculo->delete();
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function edit_relative() {
        if (parent::in_group("secretaria")) {

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

    public function update_parent($p) {
        if (parent::in_group("secretaria")) {

            $this->load->helper('url');
            $persona = new Persona();
            $persona->where('id', $p)->get();
            $data['persona'] = $persona;

            $this->load->view('templates/header');
            $this->load->view('aspirante/update_parent', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function get_all_from_year(){
        if (parent::in_group("secretaria")) {

            $ciclo = (isset($_POST['ciclo_lectivo'])) ? $_POST['ciclo_lectivo'] : date("Y");
            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            $a->where("ciclo_lectivo", 2013)->get();
            $data['aspirantes'] = $a;        
            $data['parametros'] = $_POST;   
            $this->load->view('aspirante/all_from_year', $data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }
    public function get_inscriptos() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            $a->where("estado", 1)->get();
            $data['aspirantes'] = $a;
            $pre_inscriptos = new Aspirante();
            $pre_inscriptos->where("estado", 2)->get();
            $data['pre_inscriptos'] = $pre_inscriptos;
            $data['parametros'] = $_POST;
            $this->load->view('aspirante/inscriptos', $data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function preadmitir_fase1() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            foreach ($_POST['aspirante'] as $key => $value) {
                if ($value == 'on') {
                    $a->where('id', $key)->get();
                    $a->estado = 2;
                    $a->fase = 1;
                    $a->save();
                }
            }
            redirect("/aspirantes/proceso_admision");
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function no_admitir() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            foreach ($_POST['aspirante'] as $key => $value) {
                if ($value == 'on') {
                    $a->where('id', $key)->get();
                    $a->estado = 0;
                    $a->save();
                }
            }
            redirect("/aspirantes/proceso_admision");
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function get_preadmitidos_fase1() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            $b = new Aspirante();
            $data['fase1'] = $a->where("estado", 2)->where("fase", 1)->get();
            $data['aspirantes'] = $b->where("estado", 2)->where("fase >", 1)->order_by("fase")->get();

            $this->load->view('aspirante/pre_admitidos', $data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function preadmitir_fase2() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            foreach ($_POST['aspirante'] as $key => $value) {
                if ($value['changed'] == 'on') {
                    $a->where('id', $key)->get();
                    $a->dt_evaluacion1 = $value['dt_evaluacion1'];
                    $a->dt_evaluacion2 = $value['dt_evaluacion2'];
                    $a->dt_entrevista = $value['dt_entrevista'];
                    $a->dt_carta = $value['dt_carta'];
                    if (($a->fase < 2) && ($a->dt_evaluacion1 != "") && ($a->dt_evaluacion2 != "") && ($a->dt_entrevista != "") && ($a->dt_carta != "")) {
                        $a->fase = 2;
                    }
                    $a->save();
                }
            }
            redirect("/aspirantes/proceso_admision");
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function get_preadmitidos_fase2() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            $b = new Aspirante();
            $data['fase2'] = $a->where("estado", 2)->where("fase", 2)->get();
            $data['aspirantes'] = $b->where("estado", 2)->where("fase >", 2)->order_by("fase")->get();
            $this->load->view('aspirante/pre_admitidos_fase2', $data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function preadmitir_fase3() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            foreach ($_POST['aspirante'] as $key => $value) {
                if ($value['changed'] == 'on') {
                    $a->where('id', $key)->get();
                    $a->estado_deuda = $value['estado_deuda'];
                    $a->dt_contrato_reserva = $value['dt_contrato_reserva'];
                    $a->dt_pago_matricula = $value['dt_pago_matricula'];
                    if (($a->fase < 3) && ($a->estado_deuda != "") && ($a->dt_contrato_reserva != "") && ($a->dt_pago_matricula != "")) {
                        $a->fase = 3;
                    }
                    $a->documentacion->delete_all();
                    $d = new Documentacion();
                    $d->from_array($value, '', false);
                    $a->save($d);
                }
            }
            redirect("/aspirantes/proceso_admision");
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function preadmitir_fase4() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            foreach ($_POST['aspirante'] as $key => $value) {
                if ($value['changed'] == 'on') {
                    $a->where('id', $key)->get();
                    if (($value['dt_admision'] != "") and (isset($value['dni'])) and (isset($value['cert_nacimiento']))  and (isset($value['cert_buco_dental'])) and (isset($value['cert_buena_salud'])) and (isset($value['plan_vacunacion'])) and (isset($value['fotos_carnet'])) and (isset($value['solicitud_inscripcion']))) {
                        $a->estado = 3;
                        $a->dt_admision = $value['dt_admision'];
                        $a->save();
                    }
                    $a->documentacion->delete_all();
                    $d = new Documentacion();
                    $d->dni = isset($value['dni']);
                    $d->cert_nacimiento = isset($value['cert_nacimiento']);
                    $d->cert_bautismo = isset($value['cert_bautismo']);
                    $d->cert_buco_dental = isset($value['cert_buco_dental']);
                    $d->cert_buena_salud = isset($value['cert_buena_salud']);
                    $d->plan_vacunacion = isset($value['plan_vacunacion']);
                    $d->fotos_carnet = isset($value['fotos_carnet']);
                    $d->solicitud_inscripcion = isset($value['solicitud_inscripcion']);
                    $d->save($a);
                }
            }
            redirect("/aspirantes/proceso_admision");
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function get_preadmitidos_fase3() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            $b = new Aspirante();
            $data['fase3'] = $a->where("estado", 2)->where("fase", 3)->get();
            $data['aspirantes'] = $b->where("estado", 2)->where("fase >", 3)->order_by("fase")->get();
            $this->load->view('aspirante/pre_admitidos_fase3', $data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function convertir_en_alumnos() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            foreach ($_POST['aspirante'] as $key => $value) {
                if ($value == 'on') {
                    $a->where('id', $key)->get();
                    $a->estado = 4;
                    $a->save();
                    $alumno = new Alumno();
                    $alumno->establecimiento_id = $_SESSION['establecimiento_id'];
                    $alumno->save($a->persona);
                    $av = new Alumno_vigencia();
                    $av->estado = 1;
                    $av->fecha = $_POST["dt_ingreso"];
                    $av->save(array($alumno));
                }
            }
            redirect("/aspirantes/proceso_admision");
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function get_admitidos() {
        if (parent::in_group("secretaria")) {

            $this->load->helper('form');
            $this->load->helper('url');
            $a = new Aspirante();
            $data['admitidos'] = $a->where("estado", 3)->get();
            $this->load->view('aspirante/admitidos', $data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function proceso_admision() {
        if (parent::in_group("secretaria")) {

            $this->load->view('templates/header');
            $this->load->view("aspirante/proceso_admision", $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

}

?>
