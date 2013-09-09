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
class Personal_licencia extends DataMapper {
    var $table = 'personal_licencia';
    var $has_one = array("personal");
    var $has_many = array("prestacion");
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    
    function getTipoLicencia(){
        $tipo = new Wtipo_licencia();
        $tipo->where('id',$this->tipo_licencia)->get();
        return $tipo;
    }
    
    function getPrestaciones(){
        $sql = "SELECT * FROM personal_licencia_prestacion_personal WHERE personal_licencium_id = ".$this->id;                
        $p = new Personal_licencia_prestacion_personal();
        $p->query($sql);
        $out = array();
        foreach ($p as $prestacion_licencia) {
            $p = new Prestacion();
            $p->where('id',$prestacion_licencia->prestacion_id)->get();
            $out[] = $p;
        }                   
        return $out;
    }
}

?>
