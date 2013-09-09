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
    var $default_order_by = array('ds_sexo');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
