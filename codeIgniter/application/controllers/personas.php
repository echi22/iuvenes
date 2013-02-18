<?php

class Personas extends CI_Controller {
        
        public function __construct()
	{
		parent::__construct();
                $this->load->library('parser');
                $this->load->library('personalibrary');
                
	}
        
        public function create($popup = false)
        {
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('form_validation');    
                $this->form_validation->set_rules('nombres', 'Nombres', 'required');
                $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');                
                $data = $this->personalibrary->get_create_view_data();
                $data['popup'] = $popup;                      
                $data['nombres'] = $_POST['nombres'];
                $data['apellidos'] = $_POST['apellidos'];
                $data['cd_identificacion'] = $_POST['cd_identificacion'];
                $data['nu_identificacion'] = $_POST['nu_identificacion'];                          
                if($_POST[form_submited] == 1){                     
                    if ($this->form_validation->run() === FALSE  )
                    {
                            $this->load->view('templates/header');	
                            $this->parser->parse('persona/create',$data);
                    }else{
                        $p = $this->personalibrary->save_data();    
                        if(!$popup){                       
                            redirect("alumnos/alumno_data/".$p->id);
                        }
                        else
                            redirect("alumnos/update_parent/".$p->id);
                    }
                }else{                    
                    $this->load->view('templates/header');	
                    $this->parser->parse('persona/create',$data);
                }              
                

                
        }        
        
        public function get_all(){
            $p = new Persona();
            $p->get();
            $data['personas'] = $p;
            $this->load->view('templates/header');
            $this->load->view('persona/list_all',$data);
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
                 $data['personas'] = $p;
             }
             $this->load->view('templates/header');
             $this->load->view('persona/buscar',$data);
             $this->load->view('templates/footer');
        }
}       
?>
