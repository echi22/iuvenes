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
class Alumno extends DataMapper {
    var $table = 'alumno';
    var $has_one = array("persona","establecimiento");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
