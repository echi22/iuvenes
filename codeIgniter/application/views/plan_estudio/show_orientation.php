<script type="text/javascript" src="<?php echo base_url(); ?>js/PlanEstudioView.js"></script>
<script type="text/javascript">
    planEstudioView = new PlanEstudioView();
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">
    <div id="insert_form" class="content-center">
        <div class="titulo">
            Consulta Orientación
        </div>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Orientación</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class = Array("odd", "even");
                foreach ($orientation as $i => $o) {
                    ?>
                    <tr id="row_orientation_<?php echo $o->id; ?>" class="<?php echo $class[($i % 2)]; ?>">
                        <td>
                            <p class="no_edit_<?php echo $o->id; ?>" id="orientation_no_edit_<?php echo $o->id; ?>"><?php echo $o->ds_orientacion; ?> </p>
                            <input class="edit_<?php echo $o->id; ?> hidden" size="40" type="text" id="orientation_<?php echo $o->id; ?>" value="<?php echo $o->ds_orientacion; ?>" />
                        </td>
                <input type="hidden" value="<?php echo $o->id; ?>" id="orientation<?php echo $i; ?>_id" />                  
                <td>
                    <div class="no_edit_<?php echo $o->id; ?> ">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Modificar" onclick="planEstudioView.show_editable(<?php echo $o->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="planEstudioView.delete_element('orientation',<?php echo $o->id; ?>,this);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                        </div>   
                    </div>
                    <div class="edit_<?php echo $o->id; ?> hidden">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Guardar" onclick="planEstudioView.edit_orientation(<?php echo $o->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="planEstudioView.hide_editable(<?php echo $o->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                        </div>    
                    </div>
                </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div style="clear: both"></div>
        <?php include('application/views/templates/pager.php'); ?>
        <div >
            <div id="icons" style="float: left;">
                <li class="ui-state-default ui-corner-all" onclick="location.href = 'add_orientation';"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li> 
            </div>  
            <p style="padding-top: 5px;">Agregar Nuevo</p>
        </div>
    </div>
</div>