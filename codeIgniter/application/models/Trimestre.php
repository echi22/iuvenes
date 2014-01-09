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
class Trimestre extends DataMapper{
    var $table = 'trimestre';    
    var $default_order_by = array('id');
    var $has_many = array('nota');
    var $has_one = array('curso');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
