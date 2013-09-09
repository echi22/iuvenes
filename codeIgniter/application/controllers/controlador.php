<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controlador
 *
 * @author Nico
 */
class Controlador extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_states_from_country(){
        $s = new State();
        $s->where_related('country','id',$_POST['country_id'])->order_by("ds_provincia")->get();
        echo json_encode($s->all_to_array());
    }
    public function get_localidades_from_state(){
        $l = new Localidad();
        $l->where_related('state','id',$_POST['state_id'])->order_by("ds_localidad")->get();
        echo json_encode($l->all_to_array());
    }
    public function in_group($array){
        return (($this->ion_auth->in_group($array)) || $this->ion_auth->is_admin());
    }
}

?>
