<?php
class Personales extends CI_Controller {
        
        public function __construct()
	{
		parent::__construct();
                $this->load->library('parser');
                $this->load->helper('form');
                $this->load->library('personalibrary');
                $this->load->model('personal');
                $this->load->model('titulo');
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
                        $this->parser->parse('personal/create',$data);
                        $this->load->view('templates/footer');
                }
                else
                {              
                   $p = $this->personalibrary->save_data();
                   $personal = new Personal();   
                   $personal->CUIL = $_POST['cuil'];
                   $personal->save($p);
                   for($i = 0; $i < $_POST['cant_titulo']; $i++){
                       if(isset($_POST['titulo_'.$i.'_'])){
                            $array = $_POST['titulo_'.$i.'_'];                        
                            $titulo = new Titulo();
                            $titulo->from_array($array,'',false);
                            $titulo->save($personal->persona);
                        }
                    }
                   redirect("personales/personal_data/".$personal->persona->id);
                }
        }
        public function modify($id)
        {
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('form_validation');    
                $this->form_validation->set_rules('nombres', 'Nombres', 'required');
                $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
                $data = $this->personalibrary->get_create_view_data();
                $p = new Personal();
                $p->where('persona_id',$id)->get();

                $data['personal'] = $p;
            
                
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header');	
                        $this->parser->parse('alumno/modify',$data);
                        $this->load->view('templates/footer');
                }
                else
                {     
                   
                   $personal = new Personal();
                   $personal->where('persona_id',$_POST['persona_id'])->get();
                   $p = new Persona();
                   $p = $personal->persona;
                   $p = $this->personalibrary->save_data($p->id);
                   $personal->CUIL = $_POST['cuil'];
                   $personal->save($p);
                   for($i = 0; $i < $_POST['cant_titulo']; $i++){
                       if(isset($_POST['titulo_'.$i.'_'])){
                           echo "saf";
                            $array = $_POST['titulo_'.$i.'_'];                        
                            $titulo = new Titulo();
                            $titulo->from_array($array,'',false);
                            $titulo->save($personal->persona);
                        }
                    }
                         
//                   redirect("personales/personal_data/".$personal->persona->id);
                }
        }
        
        public function personal_data($id){
            $this->load->helper('url');
            $a = new Personal();
            $a->where('persona_id',$id)->get();
            $data = $this->personalibrary->get_create_view_data();
            $data['personal'] = $a;
            
            $this->load->view('templates/header');
            $this->parser->parse('personal/datos_personal',$data);
             $this->load->view('templates/footer');
            
        }
        
        public function add_prestacion(){
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Prestacion');
            $this->load->model('Cargo');
            $this->load->model('Tipo_liquidacion_sueldo');
            $this->load->model('Wsituacion_revista');
            $data['liquidacion_sueldo'] = new Tipo_liquidacion_sueldo();
            $data['liquidacion_sueldo']->get();  
            $data['wsituacion_revista'] = new Wsituacion_revista();
            $data['wsituacion_revista']->get();     
            $data['cargo'] = new Cargo();
            $data['cargo']->get();                          

            $this->load->view('templates/header');
            $this->load->view('personal/nueva_prestacion',$data);
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
            $vinculo->parentezco = $this->input->post('parentezco');
            $vinculo->save(array('persona' =>$a,'pariente'=>$p));    
            $this->alumno_data($id);
        }
        
        public function delete_related(){
            $vinculo = new Persona_familiar();
            echo $_POST['alumnoId'];
            echo $_POST['relatedId'];
            $vinculo->get_where(array('persona_id' => $_POST['alumnoId'], 'pariente_id' => $_POST['relatedId']));
            echo $vinculo->persona_id;
            echo "afdsaf";
            $vinculo->delete();
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
