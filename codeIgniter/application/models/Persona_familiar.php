<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona_familiar
 *
 * @author echi
 */
class Persona_familiar extends DataMapper{
    var $table = 'persona_familiar';
    var $has_one = array(
        'persona' => array(
            'class' => 'persona',
            'other_field' => 'persona_es'
        ),
        'pariente' => array(
            'class' => 'persona',
            'other_field' => 'persona_de'
        )
    );
    function __construct($id = NULL)
       {
           parent::__construct($id);
       }
}

?>
