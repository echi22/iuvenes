<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class CursoLibrary {
    
    public function get_create_view_data(){
        $CI =& get_instance();
        $CI->load->model('Establecimiento');
        $CI->load->model('orientation');
        $CI->load->model('nivel_educativo');
        $CI->load->model('alumno');

        $data['orientacion'] = new Orientation();
        $data['orientacion'] = $data['orientacion']->get()->all_to_array();                
        $data['nivel_educativo'] = new Nivel_educativo();
        $data['nivel_educativo'] = $data['nivel_educativo']->get()->all_to_array();                              
        $data['años_cursos'] = new Curso();                                
        $data['años_cursos'] = $data['años_cursos']->get_all_cursos_years();                                           
        array_unshift($data['años_cursos'], $data['años_cursos'][0]);
        $data['años_cursos'][0]['id_ciclo_lectivo'] = 'Todos';
        $data['cursos'] = new Curso(); 
        $data['cursos'] = $data['cursos']->get()->all_to_array();
        return $data;
    }
    public function save_data($id = -1)
    {
        $CI =& get_instance();
        $target_path = "uploads/";
        if($_FILES['image']['name'] != ""){
            $target_path = $target_path . basename( $_FILES['image']['name']);  
            move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
        }
        else
            $target_path = $target_path. "default-avatar.gif";
        
        

        $country = new Country();
        $country->where('id', $CI->input->post('nacionalidad'))->get();
        $estado_civil = new Estado_civil();
        $estado_civil->where('id', 1)->get();                        
        $sexo = new Sexo();
        $sexo->where('id', $CI->input->post('sexo'))->get();  

        $establecimiento = new Establecimiento();
        $establecimiento->where('id',$CI->input->post('id_establecimiento'))->get();             
        $p = new Persona();        
        if($id != -1){     
            $p->where('id',$id)->get();
            $p->domicilio->delete_all();
            $p->persona_identificacion->delete_all();
            $p->telefono->delete_all();
            if($target_path == "uploads/default-avatar.gif")
                $target_path = $p->foto;
            $p->titulo->delete_all();
        }
        $p->from_array($_POST,'',false);
        $p->foto = $target_path;
        $p->save(array($estado_civil,$country, $establecimiento,$sexo));
        for($i = 0; $i < $_POST['cant_domicilio']; $i++){
            if (isset($_POST['domicilio_'.$i.'_'])){
                $array = $_POST['domicilio_'.$i.'_'];            
                $dom = new Domicilio();    
                $pais_dom = new Country();
                $pais_dom->where('id',$array['country'])->get();
                $provincia = new State();
                $provincia->where('id',$array['provincia'])->get();
                $localidad = new Localidad();
                $localidad->where('id',$array['localidad'])->get();
                $dom->from_array($array, '', false);
                $dom->save(array($provincia,$localidad, $pais_dom));
                $p->save($dom);
            }
        }
        $cod_area = $CI->input->post('cod_area');
        $tipo_tel = $CI->input->post('tipo_tel');
        $telefono = $CI->input->post('telefono');
        for($i = 0; $i < count($cod_area); $i++){
            $t = new Telefono();
            $t->wtipo_telefono_id = $tipo_tel[$i];
            $t->nu_area = $cod_area[$i];
            $t->nu_tel  = $telefono[$i];
            $t->save($p);
        }
        for($i = 0; $i < $_POST['cant_identificacion']; $i++){
            
            if(isset($_POST['identificacion_'.$i.'_'])){
                $array = $_POST['identificacion_'.$i.'_'];
                $identificacion = new Widentificacion();
                $identificacion->where('id',$array['cd_identificacion'])->get();
                $persona_identificacion = new Persona_identificacion();
                $persona_identificacion->from_array($array,'',false);
                $persona_identificacion->principal = 1;
                $persona_identificacion->save(array($p,$identificacion));
            }
        }
        return $p;
    }
}
