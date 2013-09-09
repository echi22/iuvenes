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
class Tipo_adelanto extends DataMapper {
    var $table = 'tipo_adelanto';
    var $has_many = array("personal_adelanto");
    var $default_order_by = array('detalle');
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
