<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Domicilio
 *
 * @author echi
 */
class Domicilio extends DataMapper{
    var $table = 'domicilio'; 
    var $has_one = array('localidad','country','state');
    var $has_many = array('persona');    
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}
?>
