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
class Hora extends DataMapper{
    var $table = 'hora';    
    var $default_order_by = array('id');
    var $has_many = array('horario');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
