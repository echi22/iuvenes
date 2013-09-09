<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alumno_model
 *
 * @author echi
 */
class Cargo extends DataMapper {
    var $table = 'cargo';
    var $has_many = array("prestacion");
    var $default_order_by = array('ds_cargo');
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
