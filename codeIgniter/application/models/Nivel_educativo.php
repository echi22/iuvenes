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
class Nivel_educativo extends DataMapper{
    var $table = 'nivel_educativo';
    var $has_one = array('ley');
    var $has_many = array('anio_nivel');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
