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
class Personal_vigencia extends DataMapper{
     var $table = "personal_vigencia";
     var $has_one = array("personal");
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
