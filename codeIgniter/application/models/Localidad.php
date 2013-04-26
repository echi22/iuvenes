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
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
