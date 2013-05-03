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
            redirect("personales/personal_data/" . $personal->persona->id);
        }
    }

    public function modify($id) {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $data = $this->personalibrary->get_create_view_data();
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
    }

    public function personal_data($id) {
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
        $data['personal'] = $a;
        $this->load->view('templates/header');
        $this->parser->parse('personal/datos_personal', $data);
        $this->load->view('templates/footer');
    }

    public function add_prestacion($id) {
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
    }

    public function addLicencia($id) {
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
            redirect("personales/personal_data/" . $prestacion->personal->persona->id);
        }
    }

    public function save_licencia_data($licencia, $data) {

        $licencia->from_array($data, '', false);
        $personal = new Personal();
        $personal->where('persona_id', $data['persona_id'])->get();
        $licencia->save(array($personal));
        foreach ($_POST['prestacion'] as $i => $value) {
            $sql = "INSERT INTO personal_licencia_prestacion_personal (personal_licencium_id, prestacion_id) values (" . $licencia->id . "," . $i . ")";
            $query = mysql_query($sql);
        }
        return $licencia;
    }

    public function save_prestacion_data($prestacion, $data) {

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
    }

    public function edit_prestacion() {
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
    }

    public function edit_licencia() {
        $licencia = new Personal_licencia();
        $licencia->where('id', $_POST['licencia_id'])->get();
        $licencia = $this->save_licencia_data($licencia, $_POST);
        $data['dt_inicio'] = $licencia->dt_inicio;
        $data['dt_fin'] = $licencia->dt_fin;
        $data['tipo_licencia'] = $licencia->getTipoLicencia()->detalle;
        echo json_encode($data);
    }

    public function delete_prestacion() {
        $prestacion = new Prestacion();
        $prestacion->where('id', $_POST['prestacion_id'])->get();
        $prestacion->delete();
    }

    public function delete_licencia() {
        $licencia = new Personal_licencia();
        $licencia->where('id', $_POST['licencia_id'])->get();
        $licencia->delete();
    }

    public function buscar() {
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
            $p->get();
            $a = new Personal();
            if ($_POST['vigente'] != "")
                $a->where('vigente', $_POST['vigente']);
            $a->where_related('persona', 'id', $p);
            $a->where_related("establecimiento", 'id', $_SESSION['establecimiento_id'])->get();
            $data['personales'] = $a;
            $data['parametros'] = $_POST;
        }
        $this->load->view('templates/header');
        $this->load->view('personal/buscar', $data);
        $this->load->view('templates/footer');
    }

    public function change_state() {
        $a = new Personal();
        $a->where('id', $_POST['personal_id']);
        $a->get();
        $a->vigente = !$a->vigente;
        $a->save();       
    }

}

?>
