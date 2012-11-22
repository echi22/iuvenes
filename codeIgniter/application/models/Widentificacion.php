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
class Widentificacion extends DataMapper{
     var $table = 'widentificacion';
     var $has_many = array('persona_identificacion');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
