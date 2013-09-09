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
class Titulo extends DataMapper {
    var $table = 'titulo';
    var $has_one = array("persona");
    var $default_order_by = array('fecha'=>'desc');
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
