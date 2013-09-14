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
            Consulta Materia
        </div>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Materia</th><th>Color</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class = Array("odd", "even");
                foreach ($materias as $i => $m) {
                    ?>
                    <tr id="row_materium_<?php echo $m->id; ?>" class="<?php echo $class[($i % 2)]; ?>">
                        <td>
                            <p class="no_edit_<?php echo $m->id; ?>" id="materium_no_edit_<?php echo $m->id; ?>"><?php echo $m->nombre; ?> </p>
                            <input class="edit_<?php echo $m->id; ?> hidden" size="40" type="text" id="materium_<?php echo $m->id; ?>" value="<?php echo $m->nombre; ?>" />
                        </td>
                        <td>
                            <input class="no_edit_<?php echo $m->id; ?>" type="color" readonly="readonly" disabled="disabled" value="<?php echo $m->color; ?>" id="color_no_edit_<?php echo $m->id; ?>"/>
                            <input class="edit_<?php echo $m->id; ?> hidden" type="color" id="color_<?php echo $m->id; ?>" value="<?php echo $m->color; ?>" />
                        </td>
                        <input type="hidden" value="<?php echo $m->id; ?>" id="materium<?php echo $i; ?>_id" />                  

                        <td>
                            <div class="no_edit_<?php echo $m->id; ?> ">
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Modificar" onclick="planEstudioView.show_editable(<?php echo $m->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                                </div> 
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="planEstudioView.delete_element('materium',<?php echo $m->id; ?>,this);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                                </div>   
                            </div>
                            <div class="edit_<?php echo $m->id; ?> hidden">
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Guardar" onclick="planEstudioView.edit_materium(<?php echo $m->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                                </div> 
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="planEstudioView.hide_editable(<?php echo $m->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
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
                <li class="ui-state-default ui-corner-all" onclick="location.href = 'add_materia';"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li> 
            </div>  
            <p style="padding-top: 5px;">Agregar Nuevo</p>
        </div>
    </div>
</div>