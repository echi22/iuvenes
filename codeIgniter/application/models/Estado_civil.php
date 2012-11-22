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
class Estado_civil extends DataMapper{
     var $table = "estado_civil";
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
