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
class Localidad extends DataMapper{
     var $table = 'localidad';
     var $has_one = array('state');
     var $has_many = array('domicilio');
     var $default_order_by = array('ds_localidad');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
