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
class Curso_prestacion_personal extends DataMapper{
     var $table = 'curso_prestacion_personal';     
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
