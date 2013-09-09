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
class Alumno_vigencia extends DataMapper{
     var $table = "alumno_vigencia";
     var $has_one = array("alumno");
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
