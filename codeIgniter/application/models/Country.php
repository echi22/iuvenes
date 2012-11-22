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
class Country extends DataMapper{
     var $table = 'country';
     var $has_many=array('persona','domicilio');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
