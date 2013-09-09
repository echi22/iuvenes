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
class Establecimiento extends DataMapper{
     var $table = 'establecimiento';
     var $has_many = array('alumno','user','personal','aspirante');
     var $default_order_by = array('ds_establecimiento');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
