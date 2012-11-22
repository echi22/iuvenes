<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tipo_telefono
 *
 * @author echi
 */
class Wtipo_telefono extends DataMapper{
     var $table = 'wtipo_telefono';
     var $has_many = array('telefono');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
