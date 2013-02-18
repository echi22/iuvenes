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
class Curso extends DataMapper{
    var $table = 'curso';
    var $has_many = array('alumno','personal');
    var $has_one = array('establecimiento','orientation','nivel_educativo');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
