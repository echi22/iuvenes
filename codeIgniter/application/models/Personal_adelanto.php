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
class Personal_adelanto extends DataMapper {
    var $table = 'personal_adelanto';
    var $has_one = array("personal","estado_adelanto","tipo_adelanto");
    var $has_many = array("prestacion");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    
    function getPrestaciones(){
        $sql = "SELECT * FROM personal_adelanto_prestacion_personal WHERE personal_adelanto_id = ".$this->id;                
        $p = new Personal_adelanto_prestacion_personal();
        $p->query($sql);
        $out = array();
        foreach ($p as $prestacion_adelanto) {
            $p = new Prestacion();
            $p->where('id',$prestacion_adelanto->prestacion_id)->get();
            $out[] = $p;
        }                   
        return $out;
    }
}

?>
