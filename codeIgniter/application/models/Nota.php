<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of persona
 *
 * @author echi
 */
class Nota extends DataMapper{
    var $table = 'nota';    
    var $default_order_by = array('id');
    var $has_one = array('alumno','materium','trimestre');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
