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
    var $has_many = array("licencia");
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
