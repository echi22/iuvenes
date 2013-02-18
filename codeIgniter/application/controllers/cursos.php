<?php
class Cursos extends CI_Controller {
        
        public function __construct()
	{
		parent::__construct();
                $this->load->library('parser');
                $this->load->helper('form');    
                $this->load->model('orientation');
                $this->load->model('nivel_educativo');
                $this->load->model('alumno');
	}
        
        public function create()
        {
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('form_validation');    
                $this->form_validation->set_rules('id_ciclo_lectivo', 'Ciclo Lectivo', 'required');                
                $data['orientacion'] = new Orientation();
                $data['orientacion'] = $data['orientacion']->get()->all_to_array();                
                $data['nivel_educativo'] = new Nivel_educativo();
                $data['nivel_educativo'] = $data['nivel_educativo']->get()->all_to_array();                        
                $data['alumnos'] = new Alumno();                
                $data['alumnos'] = $data['alumnos']->include_all_related()->order_by('persona_apellidos','persona_nombres')->get();
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header');	
                        $this->parser->parse('curso/create',$data);
                        $this->load->view('templates/footer');
                }
                else
                {              
                   $c = new Curso();
                   $c->from_array($_POST,'',false);
                   $o = new Orientation();
                   $o->where(id,$_POST['orientacion'])->get();
                   $ne = new Nivel_educativo();
                   $ne->where(id,$_POST['nivel'])->get();
                   $c->establecimiento_id = 1;
                   $c->save(array($o,$ne));
                         
                   redirect("cursos/curso_data/".$c->id);
                }
        }
}
?>
