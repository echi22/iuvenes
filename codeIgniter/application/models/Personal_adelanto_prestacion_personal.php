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
class Personal_adelanto_prestacion_personal extends DataMapper {
    var $table = 'personal_adelanto_prestacion_personal';    
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    
    function include_all_related() {
        foreach ($this->has_one as $h) {
            $this->include_related($h['class']);
        }

        return $this;
    }
}

?>
