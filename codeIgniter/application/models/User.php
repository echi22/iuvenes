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
class User extends DataMapper {
    var $table = 'user';
    var $has_one = array("establecimiento");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
