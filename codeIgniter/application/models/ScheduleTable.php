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
class ScheduleTable extends DataMapper{
    var $table = 'scheduletable';
    var $has_one = array('curso');
     function __construct($id = NULL)
        {
            parent::__construct($id);
        }
}

?>
