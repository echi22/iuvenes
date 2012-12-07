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
class Tipo_liquidacion_sueldo extends DataMapper {
    var $table = 'tipo_liquidacion_sueldo';
    var $has_many = array("prestacion");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
