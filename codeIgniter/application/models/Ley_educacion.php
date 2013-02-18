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
class Ley_educacion extends DataMapper{
    var $table = 'ley_educacion';    
    var $has_many = array('nivel_educativo');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
