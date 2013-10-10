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
class Horario extends DataMapper{
    var $table = 'horario';    
    var $default_order_by = array('hora_id');
    var $has_one = array('curso','hora');
    var $has_many = array('materium');
    
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
