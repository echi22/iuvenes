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
class Orientation extends DataMapper{
    var $table = 'orientation';
    var $has_many= array('curso');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
