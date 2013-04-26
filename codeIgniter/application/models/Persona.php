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
class Persona extends DataMapper{
    var $table = 'persona'; 
    var $has_one = array('country','estado_civil','alumno','sexo','personal');
    var $has_many = array('domicilio','titulo','persona_identificacion','telefono',
        'persona_es' => array(
            'class' => 'persona_familiar',
            'other_field' => 'persona'
        ),
        'persona_de' => array(
            'class' => 'persona_familiar',
            'other_field' => 'pariente'
        ));
    
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
