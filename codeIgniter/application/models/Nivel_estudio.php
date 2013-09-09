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
class Nivel_estudio extends DataMapper{
    var $table = 'nivel_estudio';
    var $has_many = array('persona');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
