<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class PersonaLibrary {

    public function save_data()
    {
        $CI =& get_instance();
        $target_path = "uploads/";
        $target_path = $target_path . basename( $_FILES['image']['name']);                     
        move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

        $country = new Country();
        $country->where('id', $CI->input->post('nacionalidad'))->get();
        $estado_civil = new Estado_civil();
        $estado_civil->where('id', 1)->get();                        
        $sexo = new Sexo();
        $sexo->where('id', $CI->input->post('sexo'))->get();  

        $establecimiento = new Establecimiento();
        $establecimiento->where('id',$CI->input->post('id_establecimiento'))->get();

        $identificacion = new Widentificacion();
        $identificacion->where('id',$CI->input->post('cd_identificacion'))->get();        
        $p = new Persona();        
        if(isset($_POST['id_persona'])){            
            $p->where('id',$_POST['id_persona'])->get();
            $p->domicilio->delete_all();
            $p->persona_identificacion->delete_all();
            $p->telefono->delete_all();
        }
        $p->from_array($_POST,'',false);
        $p->foto = $target_path;
        $p->save(array($estado_civil,$country, $establecimiento,$sexo));
        for($i = 0; $i < $_POST['cant_domicilio']; $i++){
            $array = $_POST['domicilio_'.$i.'_'];
            if(is_array($array)){
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
            $array = $_POST['identificacion_'.$i.'_'];
            if(is_array($array)){
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
