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
    var $has_one = array("nivel_educativo","orientation","curso");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
