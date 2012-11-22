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
class State extends DataMapper{
    var $table = 'state';
    var $has_many = array('domicilio');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
