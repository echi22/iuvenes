<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona_identificacion
 *
 * @author echi
 */
class Persona_identificacion extends DataMapper{
    var $table = 'persona_identificacion';
    var $has_one = array('persona','widentificacion');
    function __construct($id = NULL)
       {
           parent::__construct($id);
       }
}

?>
