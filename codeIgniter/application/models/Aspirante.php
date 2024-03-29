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
class Aspirante extends DataMapper {

    var $table = 'aspirante';
    var $has_one = array("persona", "establecimiento","documentacion");
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function get_identificacion_principal() {
//        return $this->persona->persona_identificacion->where('principal', 1)->get();
        foreach ($this->persona->persona_identificacion as $identificacion) {
            if($identificacion->principal)
                return $identificacion;
        }        
    }

    function include_all_related() {
        foreach ($this->has_one as $h) {
            $this->include_related($h['class']);
        }

        return $this;
    }

    function detalle() {
        $identificacion = $this->get_identificacion_principal();
        return $this->persona->apellidos . " " . $this->persona->nombres . " - " . $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion;
    }


}

?>
