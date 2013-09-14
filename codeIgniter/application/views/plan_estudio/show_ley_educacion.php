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
            Consulta Ley de Educación
        </div>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Ley</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Vigente</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class = Array("odd", "even");
                foreach ($ley as $i => $l) {
                    ?>                    
                    <tr id="row_ley_educacion_<?php echo $l->id; ?>" class="<?php echo $class[($i % 2)]; ?>">
                        <td>
                            <p class="no_edit_<?php echo $l->id; ?>" id="ds_ley_educacion_no_edit_<?php echo $l->id; ?>"><?php echo $l->ds_ley; ?> </p>
                            <input class="edit_<?php echo $l->id; ?> hidden" size="40" type="text" id="ds_ley_educacion_<?php echo $l->id; ?>" value="<?php echo $l->ds_ley; ?>" />
                        </td>
                        <input type="hidden" value="<?php echo $l->id; ?>" id="ley_educacion<?php echo $i; ?>_id" />                  
                        <td>
                            <p class="no_edit_<?php echo $l->id; ?>" id="dt_ini_no_edit_<?php echo $l->id; ?>"><?php echo $l->dt_ini_vig; ?> </p>
                            <input class="edit_<?php echo $l->id; ?> hidden"  type="date" id="dt_ini_<?php echo $l->id; ?>" value="<?php echo $l->dt_ini_vig; ?>" />
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $l->id; ?>" id="dt_fin_no_edit_<?php echo $l->id; ?>"><?php echo $l->dt_fin_vig; ?> </p>
                            <input class="edit_<?php echo $l->id; ?> hidden"  type="date" id="dt_fin_<?php echo $l->id; ?>" value="<?php echo $l->dt_fin_vig; ?>" />
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $l->id; ?>" id="vigente_no_edit_<?php echo $l->id; ?>"><?php echo ($l->in_vigente) ? "Vigente" : "No vigente"; ?> </p>
                            <input class="edit_<?php echo $l->id; ?> hidden"  type="checkbox" id="vigente_<?php echo $l->id; ?>" <?php if($l->in_vigente) echo "checked='true'"; ?> />
                        </td>
                        <td>
                            <div class="no_edit_<?php echo $l->id; ?> ">
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Modificar" onclick="planEstudioView.show_editable(<?php echo $l->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                                </div> 
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="planEstudioView.delete_element('ley_educacion',<?php echo $l->id; ?>,this);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                                </div>   
                            </div>
                            <div class="edit_<?php echo $l->id; ?> hidden">
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Guardar" onclick="planEstudioView.edit_ley_educacion(<?php echo $l->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                                </div> 
                                <div id="icons" style="float: left">
                                    <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="planEstudioView.hide_editable(<?php echo $l->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
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
                <li class="ui-state-default ui-corner-all" onclick="location.href = 'create';"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li> 
            </div>  
            <p style="padding-top: 5px;">Agregar Nuevo</p>
        </div>
    </div>
</div>