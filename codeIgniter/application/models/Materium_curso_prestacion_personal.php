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
class Materium_curso_prestacion_personal extends DataMapper{
     var $table = 'materium_curso_prestacion_personal';
     var $has_one = array('materium','curso','prestacion','suplente_de' => array(
            'class' => 'prestacion',
            'other_field' => 'suplente'
        ));
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
