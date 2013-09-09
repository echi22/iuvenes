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
class Materium extends DataMapper{
     var $table = 'materium';
     var $has_many = array('anio_nivel','materium_curso_prestacion_personal');
     var $default_order_by = array('nombre');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
