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
class Day extends DataMapper{
    var $table = 'day';    
    var $default_order_by = array('id');
    var $has_many = array('horario');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
