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
     var $has_many = array('alumno');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
