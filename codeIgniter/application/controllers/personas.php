<?php

class Personas extends CI_Controller {
        
        public function __construct()
	{
		parent::__construct();
                $this->load->library('parser');
                
	}
        public function create($popup = false)
        {
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('form_validation');    
                $this->form_validation->set_rules('nombres', 'Nombres', 'required');
                $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
                $this->load->model('Alumno');
                $this->load->model('Establecimiento');
                $this->load->model('Estado_civil');
                $this->load->model('Widentificacion');
                $this->load->model('Localidad');
                $this->load->model('Country');
                $this->load->model('Persona');
                $this->load->model('State');
                $this->load->model('Sexo');
                $this->load->model('Domicilio');
                $this->load->model('Wtipo_telefono');
                
                $data['estado_civil'] = new Estado_civil();
                $data['estado_civil']->get();               
                $data['sexo'] = new Sexo();
                $data['sexo'] = $data['sexo']->get()->all_to_array();
                $sql = new Country();
                $data['nacionalidad'] = $sql->get()->all_to_array();                
                $data['country'] = $sql->get()->all_to_array();
                
                $sql = new Widentificacion();
                $data['identificacion'] = $sql->get()->all_to_array();
                $sql = new State();
                $data['provincia'] = $sql->get()->all_to_array();
                $sql = new Localidad();
                $data['localidad'] = $sql->get()->all_to_array();
                $sql = new Wtipo_telefono();
                $data['telefono'] = $sql->get()->all_to_array();
                $data['popup'] = $popup;             
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header');	
                        $this->parser->parse('persona/create',$data);
                }
                else
                {              
                    $p = $this->save_data();    
                    echo $popup;
                    if(!$popup)
                        redirect("alumnos/alumno_data/".$p->id);
                    else
                        redirect("personas/update_parent/".$p->id);
                }
        }
        
        public function save_data(){
             $target_path = "uploads/";
            $target_path = $target_path . basename( $_FILES['image']['name']);                     
            move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

            $country = new Country();
            $country->where('id', $this->input->post('nacionalidad'))->get();

            $dom = new Domicilio();                      
            $pais_dom = new Country();
            $pais_dom->where('id',$this->input->post('country'))->get();

            $provincia = new State();
            $provincia->where('id',$this->input->post('provincia'))->get();
            $localidad = new Localidad();
            $localidad->where('id',$this->input->post('localidad'))->get();
            $dom->from_array($_POST, '', false);
            $dom->save(array($provincia,$localidad, $pais_dom));

            $estado_civil = new Estado_civil();
            $estado_civil->where('id', 1)->get();                        
            $sexo = new Sexo();
            $sexo->where('id', $this->input->post('sexo'))->get();  

            $establecimiento = new Establecimiento();
            $establecimiento->where('id',$this->input->post('id_establecimiento'))->get();

            $identificacion = new Widentificacion();
            $identificacion->where('id',$this->input->post('cd_identificacion'))->get();

            $cod_area = explode(",", $this->input->post('cod_area'));
            $telefono = explode(",", $this->input->post('telefono'));
            $tipo_tel = explode(",", $this->input->post('tipo_tel'));

            $p = new Persona();
            $p->from_array($_POST,'',false);
            $p->foto = $target_path;
            $p->save(array($estado_civil,$country,$dom,$sexo));
            for($i = 0; $i < count($cod_area); $i++){
                if($tipo_tel[$i] != ""){
                    $t = new Telefono();
                    $t->wtipo_telefono_id = $tipo_tel[$i];
                    $t->nu_area = $cod_area[$i];
                    $t->nu_tel  = $telefono[$i];
                    $t->save($p);
                }
            }
            $persona_identificacion = new Persona_identificacion();
            $persona_identificacion->from_array($_POST,'',false);
            $persona_identificacion->principal = 1;
            $persona_identificacion->save(array($p,$identificacion));
            return $p;
        }
        public function update_parent($p){
            $this->load->helper('url');
            $persona = new Persona();
            $persona->where('id',$p)->get();
            $data['persona'] = $persona;
            
            $this->load->view('templates/header');
            $this->load->view('persona/update_parent',$data);
            
        }
        
        public function get_all(){
            $p = new Persona();
            $p->get();
            $data['personas'] = $p;
            $this->load->view('templates/header');
            $this->load->view('persona/list_all',$data);
        }
}       
?>
