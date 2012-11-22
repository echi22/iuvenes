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
class Telefono extends DataMapper{
     var $table = 'telefono';
     var $has_one = array('persona','wtipo_telefono');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
