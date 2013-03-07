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
class Licencia extends DataMapper {
    var $table = 'personal_licencia';
    var $has_one = array("personal","wtipo_licencia");
    var $has_many = array("prestacion");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
