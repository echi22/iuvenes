<?php

include_once 'controlador.php';

class Personales extends Controlador {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->library('personalibrary');
        $this->load->library('form_validation');
        $this->load->model('personal');
        $this->load->model('titulo');
    }

    public function create() {
        if (parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $data = $this->personalibrary->get_create_view_data();
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('personal/create', $data);
                $this->load->view('templates/footer');
            } else {
                $p = $this->personalibrary->save_data();
                $personal = new Personal();
                $personal->CUIL = $_POST['cuil'];
                $personal->establecimiento_id = $_SESSION['establecimiento_id'];
                $personal->save($p);
                for ($i = 0; $i < $_POST['cant_titulo']; $i++) {
                    if (isset($_POST['titulo_' . $i . '_'])) {
                        $array = $_POST['titulo_' . $i . '_'];
                        $titulo = new Titulo();
                        $titulo->from_array($array, '', false);
                        $titulo->save($personal->persona);
                    }
                }
                $pv = new Personal_vigencia();
                $pv->estado = !$a->vigente;
                $pv->fecha = $_POST["dt_ingreso"];
                $pv->save(array($personal));
                redirect("personales/personal_data/" . $personal->persona->id);
            }
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
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $data = $this->personalibrary->get_create_view_data();
            $data['tipo_adelanto'] = new Tipo_adelanto();
            $data['tipo_adelanto']->get();
            $data['estado_adelanto'] = new Estado_adelanto();
            $data['estado_adelanto']->get();
            $p = new Personal();
            $p->where('persona_id', $id)->get();

            $data['personal'] = $p;


            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->parser->parse('alumno/modify', $data);
                $this->load->view('templates/footer');
            } else {

                $personal = new Personal();
                $personal->where('persona_id', $_POST['persona_id'])->get();
                $p = new Persona();
                $p = $personal->persona;
                $p = $this->personalibrary->save_data($p->id);
                $personal->CUIL = $_POST['cuil'];
                $personal->save($p);
                for ($i = 0; $i < $_POST['cant_titulo']; $i++) {
                    if (isset($_POST['titulo_' . $i . '_'])) {
                        echo "saf";
                        $array = $_POST['titulo_' . $i . '_'];
                        $titulo = new Titulo();
                        $titulo->from_array($array, '', false);
                        $titulo->save($personal->persona);
                    }
                }

                redirect("personales/personal_data/" . $personal->persona->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function personal_data($id) {
        if (parent::in_group(array("secretaria", "professor"))) {
            $this->load->helper('url');
            $a = new Personal();
            $a->where('persona_id', $id)->include_all_related()->get();
            $data = $this->personalibrary->get_create_view_data();
            $this->load->model('Prestacion');
            $this->load->model('Cargo');
            $this->load->model('Tipo_liquidacion_sueldo');
            $this->load->model('Wsituacion_revista');
            $this->load->model('Personal_licencia');
            $this->load->model('Wtipo_licencia');
            $data['liquidacion_sueldo'] = new Tipo_liquidacion_sueldo();
            $data['liquidacion_sueldo']->get();
            $data['wsituacion_revista'] = new Wsituacion_revista();
            $data['wsituacion_revista']->get();
            $data['cargo'] = new Cargo();
            $data['cargo']->get();
            $data['tipo_licencia'] = new Wtipo_licencia();
            $data['tipo_licencia']->get();
            $data['tipo_adelanto'] = new Tipo_adelanto();
            $data['tipo_adelanto']->get();
            $data['estado_adelanto'] = new Estado_adelanto();
            $data['estado_adelanto']->get();
            $data['personal'] = $a;
            $this->load->view('templates/header');
            $this->parser->parse('personal/datos_personal', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function add_prestacion($id) {
        if (parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Prestacion');
            $this->load->model('Cargo');
            $this->load->model('Tipo_liquidacion_sueldo');
            $this->load->model('Wsituacion_revista');
            $this->form_validation->set_rules('cargo', 'cargo', 'required');
            $this->form_validation->set_rules('dt_inicio', 'dt_inicio', 'required');
            $data['liquidacion_sueldo'] = new Tipo_liquidacion_sueldo();
            $data['liquidacion_sueldo']->get();
            $data['wsituacion_revista'] = new Wsituacion_revista();
            $data['wsituacion_revista']->get();
            $data['cargo'] = new Cargo();
            $data['cargo']->get();
            $data['persona_id'] = $id;
            $data['personal'] = new Personal();
            $data['personal']->where('persona_id', $id)->get();
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('personal/nueva_prestacion', $data);
                $this->load->view('templates/footer');
            } else {
                $prestacion = new Prestacion();
                $this->save_prestacion_data($prestacion, $_POST);
                redirect("personales/personal_data/" . $prestacion->personal->persona->id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function addLicencia($id) {
        if (parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Personal_licencia');
            $this->load->model('Wtipo_licencia');
            $this->form_validation->set_rules('dt_inicio', 'dt_inicio', 'required');
            $data['tipo_licencia'] = new Wtipo_licencia();
            $data['tipo_licencia']->get();
            $data['persona_id'] = $id;
            $data['personal'] = new Personal();
            $data['personal']->where('persona_id', $id)->get();
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('personal/nueva_licencia', $data);
                $this->load->view('templates/footer');
            } else {
                $licencia = new Personal_licencia();
                $this->save_licencia_data($licencia, $_POST);
                redirect("personales/personal_data/" . $id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function addAdelanto($id) {
        if (parent::in_group("secretaria")) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Personal_adelanto');
            $this->load->model('Tipo_adelanto');
            $this->load->model('Estado_adelanto');
            $this->form_validation->set_rules('dt_adelanto', 'Fecha', 'required');
            $this->form_validation->set_rules('monto', 'Monto', 'required');
            $data['tipo_adelanto'] = new Tipo_adelanto();
            $data['tipo_adelanto']->get();
            $data['estado_adelanto'] = new Estado_adelanto();
            $data['estado_adelanto']->get();
            $data['persona_id'] = $id;
            $data['personal'] = new Personal();
            $data['personal']->where('persona_id', $id)->get();
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('personal/nuevo_adelanto', $data);
                $this->load->view('templates/footer');
            } else {
                $adelanto = new Personal_adelanto();
                $this->save_adelanto_data($adelanto, $_POST);
                redirect("personales/personal_data/" . $id);
            }
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function save_licencia_data($licencia, $data) {
        if (parent::in_group("secretaria")) {
            $licencia->from_array($data, '', false);
            $personal = new Personal();
            $personal->where('persona_id', $data['persona_id'])->get();
            $licencia->save(array($personal));
            foreach ($_POST['prestacion'] as $i => $value) {
                $sql = "INSERT INTO personal_licencia_prestacion_personal (personal_licencium_id, prestacion_id) values (" . $licencia->id . "," . $i . ")";
                $query = mysql_query($sql);
            }
            return $licencia;
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function save_adelanto_data($adelanto, $data) {
        if (parent::in_group("secretaria")) {
            $adelanto->from_array($data, '', false);
            $personal = new Personal();
            $personal->where('persona_id', $data['persona_id'])->get();
            $tipo_adelanto = new Tipo_adelanto();
            $tipo_adelanto->where("id", $data['tipo_adelanto'])->get();
            $estado_adelanto = new Estado_adelanto();
            $estado_adelanto->where("id", $data["estado_adelanto"])->get();
            $adelanto->save(array($tipo_adelanto, $estado_adelanto, $personal));
            foreach ($_POST['prestacion'] as $i => $value) {
                $sql = "INSERT INTO personal_adelanto_prestacion_personal (personal_adelanto_id, prestacion_id) values (" . $adelanto->id . "," . $i . ")";
                echo $sql;
                $query = mysql_query($sql);
            }
            return $adelanto;
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function save_prestacion_data($prestacion, $data) {
        if (parent::in_group("secretaria")) {
            $prestacion->from_array($data, '', false);
            $cargo = new Cargo();
            $cargo->where('id', $data['cargo'])->get();
            $liquidacion_sueldo = new Tipo_liquidacion_sueldo();
            $liquidacion_sueldo->where('id', $data['tp_liq_sueldo'])->get();
            $revista = new Wsituacion_revista();
            $revista->where('id', $data['revista'])->get();
            $personal = new Personal();
            $personal->where('persona_id', $data['persona_id'])->get();
            $prestacion->asig_familiar = $data['asig_familiar'] == 'on';
            $prestacion->save(array($personal, $cargo, $liquidacion_sueldo, $revista));
            return $prestacion;
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function edit_prestacion() {
        if (parent::in_group("secretaria")) {
            $prestacion = new Prestacion();
            $prestacion->where('id', $_POST['prestacion_id'])->get();
            $prestacion = $this->save_prestacion_data($prestacion, $_POST);
            $data['cargo'] = $prestacion->cargo->ds_cargo;
            $data['dt_inicio'] = $prestacion->dt_inicio;
            $data['dt_fin'] = $prestacion->dt_fin;
            $data['estado'] = $prestacion->estado;
            $data['qt_horas'] = $prestacion->qt_horas;
            $data['nu_secuencia'] = $prestacion->nu_secuencia;
            $data['tp_liq_sueldo'] = $prestacion->tipo_liquidacion_sueldo->detalle;
            $data['revista'] = $prestacion->wsituacion_revista->ds_sit_revista;
            $data['asig_familiar'] = ($prestacion->asig_familiar) ? 'Si' : 'No';
            $data['porc_asig_familiar'] = $prestacion->porc_asig_familiar;
            echo json_encode($data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function edit_licencia() {
        if (parent::in_group("secretaria")) {
            $licencia = new Personal_licencia();
            $licencia->where('id', $_POST['licencia_id'])->get();
            $licencia = $this->save_licencia_data($licencia, $_POST);
            $data['dt_inicio'] = $licencia->dt_inicio;
            $data['dt_fin'] = $licencia->dt_fin;
            $data['tipo_licencia'] = $licencia->getTipoLicencia()->detalle;
            echo json_encode($data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function edit_adelanto() {
        if (parent::in_group("secretaria")) {
            $adelanto = new Personal_adelanto();
            $adelanto->where('id', $_POST['adelanto_id'])->get();
            $adelanto = $this->save_adelanto_data($adelanto, $_POST);
            $data['dt_adelanto'] = $adelanto->dt_adelanto;
            $data['dt_cobro'] = $adelanto->dt_cobro;
            $data['monto'] = $adelanto->monto;
            $data['tipo_adelanto'] = $adelanto->tipo_adelanto->detalle;
            $data['estado_adelanto'] = $adelanto->estado_adelanto->detalle;
            echo json_encode($data);
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_prestacion() {
        if (parent::in_group("secretaria")) {
            $prestacion = new Prestacion();
            $prestacion->where('id', $_POST['prestacion_id'])->get();
            $prestacion->delete();
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_licencia() {
        if (parent::in_group("secretaria")) {
            $licencia = new Personal_licencia();
            $licencia->where('id', $_POST['licencia_id'])->get();
            $licencia->delete();
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function delete_adelanto() {
        if (parent::in_group("secretaria")) {
            $adelanto = new Personal_adelanto();
            $adelanto->where('id', $_POST['adelanto_id'])->get();
            $adelanto->delete();
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function buscar() {
        if (parent::in_group(array("secretaria", "professor"))) {
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Widentificacion');
            $sql = new Widentificacion();
            $data['identificacion'] = $sql->get();
            $sql = new Establecimiento();
            $data['establecimiento'] = $sql->get()->all_to_array();
            if ($this->input->post('busqueda') == 'si') {
                $a = new Personal();
                if ($_POST['vigente'] != "")
                    $a->where('vigente', $_POST['vigente']);
                if (!isset($_POST["establecimiento"])) {
                    $a->where_related("establecimiento", 'id', $_SESSION['establecimiento_id']);
                } else {
                    if ($_POST["establecimiento"] != 0) {
                        $a->where_related("establecimiento", 'id', $_POST['establecimiento']);
                    }
                } if ($this->input->post('apellidos') <> "")
                    $a->like_related("persona", 'apellidos', $this->input->post('apellidos'));
                if ($this->input->post('nombres') <> "")
                    $a->like_related("persona", 'nombres', $this->input->post('nombres'));
                if (($this->input->post('cd_identificacion') <> "") || ($this->input->post('numero_identificacion') <> "")) {
                    $identificacion = new Persona_identificacion();
                    if ($this->input->post('cd_identificacion') <> "")
                        $identificacion->where('widentificacion_id', $this->input->post('cd_identificacion'));
                    if ($this->input->post('numero_identificacion') <> "")
                        $identificacion->like('numero_identificacion', $this->input->post('numero_identificacion'));
                    $identificacion->get();
                    $p = new Persona();
                    $p->select('id')->where_related("persona_identificacion", "id", $identificacion);
                    $a->where_in_subquery("persona_id", $p);
                }
                $a->order_by_related("persona", "apellidos,nombres")->limit(10, (($_POST["page"] * 10)) - 10)->get();
                $data['personales'] = $a;
                $data['total'] = $a->count();
                $data['parametros'] = $_POST;
                $data['last_page'] = $data['total'] / 10;
                $data['page'] = $_POST["page"];
            }
            $this->load->view('templates/header');
            $this->parser->parse('personal/buscar', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

    public function change_state() {
        if (parent::in_group("secretaria")) {
            $a = new Personal();
            $a->where('id', $_POST['personal_id']);
            $a->get();

            $av = new Personal_vigencia();
            $av->estado = !$a->vigente;
            $av->fecha = $_POST["fecha"];
            $av->save(array($a));

            $a->vigente = !$a->vigente;
            $a->save();
        } else {
            $_SESSION['error_message'] = "Usted no tiene permiso para acceder a esta sección";
            redirect("users/error");
        }
    }

}

?>
