<?php
class Alumnos extends CI_Controller {
        
        public function __construct()
	{
		parent::__construct();
                $this->load->library('parser');
                $this->load->helper('form');
                $this->load->library('personalibrary');
	}
        public function create()
        {
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('form_validation');    
                $this->form_validation->set_rules('nombres', 'Nombres', 'required');
                $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
                $data = $this->personalibrary->get_create_view_data();
                
                
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header');	
                        $this->parser->parse('alumno/create',$data);
                        $this->load->view('templates/footer');
                }
                else
                {              
                   $a = $this->save_data();
                         
                   redirect("alumnos/alumno_data/".$a->persona->id);
                }
        }
        public function modify($id)
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
                $sql = new Establecimiento();
                
                $data['establecimiento'] = $sql->get()->all_to_array();
                $sql = new Widentificacion();
                $data['identificacion'] = $sql->get()->all_to_array();
                $sql = new State();
                $data['provincia'] = $sql->get()->all_to_array();
                $sql = new Localidad();
                $data['localidad'] = $sql->get()->all_to_array();
                $sql = new Wtipo_telefono();
                $data['telefono'] = $sql->get()->all_to_array();
                $a = new Alumno();
                $a->where('persona_id',$id)->get();

                $data['alumno'] = $a;
            
                
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header');	
                        $this->parser->parse('alumno/modify',$data);
                        $this->load->view('templates/footer');
                }
                else
                {              
                   $a = $this->save_data();
                         
                   redirect("alumnos/alumno_data/".$a->persona->id);
                }
        }
        public function save_data(){
            
            $a = new Alumno();
            $p = new Persona();
            $id = -1;
            if(isset($_POST['id_persona'])){                
                $p->where('id',$_POST['id_persona'])->get();
                $p->domicilio->delete_all();
                $p->persona_identificacion->delete_all();
                $p->telefono->delete_all();
                $a->where('persona_id',$_POST['id_persona'])->get();
                $id = $p->id;
            }            
            $p = $this->personalibrary->save_data($id);
            $a->establecimiento_id = 1;            
            $a->save($p);
            return $a;
        }
        public function alumno_data($id){
            $this->load->helper('url');
            $a = new Alumno();
            $a->where('persona_id',$id)->get();
            $data = $this->personalibrary->get_create_view_data();
            $data['alumno'] = $a;
            
            $this->load->view('templates/header');
            $this->parser->parse('alumno/datos_alumno',$data);
             $this->load->view('templates/footer');
            
        }
        
        public function add_related_view(){
            $this->load->helper('form');
             $this->load->helper('url');
             $this->load->model('Widentificacion');
             $sql = new Widentificacion();
             $data['identificacion'] = $sql->get();
             
             if($this->input->post('busqueda') == 'si'){
                 $identificacion = new Persona_identificacion();
                 if($this->input->post('cd_identificacion') <> "")
                    $identificacion->where('widentificacion_id',$this->input->post('cd_identificacion'));
                 if($this->input->post('numero_identificacion') <> "")
                    $identificacion->where('numero_identificacion', $this->input->post('numero_identificacion'));
                 $identificacion->get();
                 $p = new Persona();
                 if($this->input->post('apellidos') <> "")
                    $p->where('apellidos',$this->input->post('apellidos'));
                 if($this->input->post('nombres')<> "")
                    $p->where('nombres',$this->input->post('nombres'));
                 $p->where_related('persona_identificacion','id',$identificacion);
                 $p->get();
                 $data['personas'] = $p;
             }
             $this->load->view('templates/header');
             $this->load->view('alumno/add_familiar',$data);
             $this->load->view('templates/footer');
        }
        public function add_related($id){
            $a = new Persona();
            $a->where('id',$id)->get();
            $p = new Persona();
            $p->where('id',$this->input->post('persona_id'))->get();
           
            $vinculo = new Persona_familiar();
            if($this->input->post('autorizado') == 'on')                
                $vinculo->autorizado = 1;
            else
                $vinculo->autorizado = 0;
            $vinculo->parentesco = $this->input->post('parentesco');
            $vinculo->save(array('persona' =>$a,'pariente'=>$p));    
            $this->alumno_data($id);
        }
        
        public function delete_related(){
            $vinculo = new Persona_familiar();
            $vinculo->where('id', $_POST['vinculo_id'])->get();
            $vinculo->delete();
        }
        
        public function edit_relative(){           
            $vinculo = new Persona_familiar();
            $vinculo->where('id', $_POST['vinculo_id'])->get();
            $vinculo->parentesco = $_POST['parentesco'];
            $vinculo->autorizado = $_POST['autorizado'] == 'true';
            $data[0] = $vinculo->parentesco;
            $data[1] = ($vinculo->autorizado) ? 'Si': 'No';
            $vinculo->save();
            echo json_encode($data);
            
        }
        public function buscar(){
             $this->load->helper('form');
             $this->load->helper('url');
             $this->load->model('Widentificacion');
             $sql = new Widentificacion();
             $data['identificacion'] = $sql->get();
             
             if($this->input->post('busqueda') == 'si'){
                 $identificacion = new Persona_identificacion();
                 if($this->input->post('cd_identificacion') <> "")
                    $identificacion->where('widentificacion_id',$this->input->post('cd_identificacion'));
                 if($this->input->post('numero_identificacion') <> "")
                    $identificacion->where('numero_identificacion', $this->input->post('numero_identificacion'));
                 $identificacion->get();
                 $p = new Persona();
                 if($this->input->post('apellidos') <> "")
                    $p->where('apellidos',$this->input->post('apellidos'));
                 if($this->input->post('nombres')<> "")
                    $p->where('nombres',$this->input->post('nombres'));
                 $p->where_related('persona_identificacion','id',$identificacion);
                 $p->get();
                 $a = new Alumno();
                 $a->where_related('persona','id',$p)->get();
                 $data['alumnos'] = $a;
             }
             $this->load->view('templates/header');
             $this->load->view('alumno/buscar',$data);
             $this->load->view('templates/footer');
        }
        
        public function update_parent($p){
            $this->load->helper('url');
            $persona = new Persona();
            $persona->where('id',$p)->get();
            $data['persona'] = $persona;
            
            $this->load->view('templates/header');
            $this->load->view('alumno/update_parent',$data);
            $this->load->view('templates/footer');
            
        }
}       
?>
