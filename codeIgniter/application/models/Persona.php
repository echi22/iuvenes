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
class Persona extends DataMapper {

    var $table = 'persona';
    var $has_one = array('country', 'estado_civil', 'alumno', 'sexo', 'personal','nivel_estudio','aspirante');
    var $has_many = array('domicilio', 'titulo', 'persona_identificacion', 'telefono',
        'persona_es' => array(
            'class' => 'persona_familiar',
            'other_field' => 'persona'
        ),
        'persona_de' => array(
            'class' => 'persona_familiar',
            'other_field' => 'pariente'
    ));
    var $default_order_by = array('apellidos','nombres');
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function get_identificacion_principal() {
        foreach ($this->persona_identificacion as $identificacion) {
            if ($identificacion->principal)
                return $identificacion;
        }
    }

}

?>
