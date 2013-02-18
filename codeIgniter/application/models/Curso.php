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
    var $has_many = array('alumno','personal');
    var $has_one = array('establecimiento','orientation','nivel_educativo');
    function __construct($id = NULL)
       {
           parent::__construct($id);
       }
    function detalle(){
        $det = $this->anio." ".$this->ds_seccion." ";
        if($this->orientation != null){
            $det .= $this->orientation->ds_orientacion;
        }
        $det .= " - ".$this->nivel_educativo->ds_nivel;
        return $det;
    }
    
    function get_all_cursos_years(){
        $query = "SELECT DISTINCT id_ciclo_lectivo FROM curso";
        $result = mysql_query($query);
        while($row = mysql_fetch_array($result)){            
            $data[] = $row;
        }
        return $data;
    }
}

?>
