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
class Anio_nivel extends DataMapper {
    var $table = 'anio_nivel';
    var $has_one = array("nivel_educativo","orientation");
    var $has_many = array("materium","curso");
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    
    function detalle(){
        return $this->ds_anio." ".$this->orientation->ds_orientacion." ".$this->nivel_educativo->ds_nivel;
    }
}

?>
