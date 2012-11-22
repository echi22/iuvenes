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
class Sexo extends DataMapper{
    var $table = 'sexo';
    var $has_one = array('persona');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
