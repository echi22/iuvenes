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
class Personal extends DataMapper {
    var $table = 'personal';
    var $has_one = array("persona");
    var $has_many = array("prestacion","curso","personal_licencia");
    
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
