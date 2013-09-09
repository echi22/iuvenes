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
class Documentacion extends DataMapper{
    var $table = 'documentacion'; 
    var $has_one = array('aspirante');   
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}
?>
