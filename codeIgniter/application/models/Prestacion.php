<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alumno_model
 *
 * @author echi
 */
class Prestacion extends DataMapper {
    var $table = 'prestacion_personal';
    var $has_one = array("personal","wsituacion_revista","tipo_liquidacion_sueldo","cargo");
    var $has_many = array("curso","persona_licencia");
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    
    function detalle(){
        return $this->personal->persona->apellidos." ".$this->personal->persona->nombres." - ".$this->cargo->ds_cargo." - ".$this->wsituacion_revista->ds_sit_revista." - ".$this->dt_inicio." - ".$this->dt_fin;
    }
}

?>
