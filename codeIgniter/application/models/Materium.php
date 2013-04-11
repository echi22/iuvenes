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
     var $has_many = array('anio_nivel');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
