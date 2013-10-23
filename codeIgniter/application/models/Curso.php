<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of persona
 *
 * @author echi
 */
class Curso extends DataMapper{
    var $table = 'curso';
    var $has_many = array('alumno','prestacion','materium_curso_prestacion_personal', 'horario');
    var $has_one = array('establecimiento','anio_nivel','scheduletable');    
    var $default_order_by = array('id_ciclo_lectivo'=>'desc');
    function __construct($id = NULL)
       {
           parent::__construct($id);
       }
    function detalle(){
        $det = $this->anio_nivel->ds_anio." ".$this->ds_seccion." ";
        if($this->anio_nivel->orientation != null){
            $det .= $this->anio_nivel->orientation->ds_orientacion;
        }
        $det .= " - ".$this->anio_nivel->nivel_educativo->ds_nivel;        
        return $det;
    }
    
    function get_all_cursos_years(){
        $query = "SELECT DISTINCT id_ciclo_lectivo FROM curso WHERE establecimiento_id = ".$_SESSION['establecimiento_id']." order by id_ciclo_lectivo DESC";
        $result = mysql_query($query);
        while($row = mysql_fetch_array($result)){            
            $data[] = $row;
        }
        return $data;
    }
    
    function turno(){
        if($this->cd_turno == 'm')
            return 'Mañana';
        else
            return 'Tarde';
    }
    
    function get_previous_curso(){
        $c = new Curso();
        $a = new Anio_nivel();
        $a->where('ds_anio',$this->anio_nivel->ds_anio-1)->where('nivel_educativo_id',$this->anio_nivel->nivel_educativo_id)->where('orientation_id',$this->anio_nivel->orientation_id)->get();
        $c->where('ds_seccion',$this->ds_seccion)->where('id_ciclo_lectivo',$this->id_ciclo_lectivo-1)->where('anio_nivel_id',$a->id)->get();
        return $c;
    }
}

?>
