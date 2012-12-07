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
class Wsituacion_revista extends DataMapper {
    var $table = 'wsituacion_revista';
    var $has_many = array("prestacion");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
