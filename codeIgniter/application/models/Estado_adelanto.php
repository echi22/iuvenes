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
class Estado_adelanto extends DataMapper{
     var $table = "estado_adelanto";
     var $has_many = array("personal_adelanto");
     var $default_order_by = array('detalle');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
