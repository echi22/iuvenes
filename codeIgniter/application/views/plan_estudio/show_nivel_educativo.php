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
            Consulta Nivel Educativo
        </div>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Nivel educativo</th><th>Ley de Educación</th><th>Fecha inicio</th><th>Fecha fin</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class = Array("odd", "even");
                foreach ($nivel_educativo as $i => $n) {
                    $l = $n->ley_educacion->id;
                    ?>
                    <tr id="row_nivel_educativo_<?php echo $n->id; ?>" class="<?php echo $class[($i % 2)]; ?>">
                        <td>
                            <p class="no_edit_<?php echo $n->id; ?>" id="nivel_educativo_no_edit_<?php echo $n->id; ?>"><?php echo $n->ds_nivel; ?> </p>
                            <input class="edit_<?php echo $n->id; ?> hidden" size="40" type="text" id="nivel_educativo_<?php echo $n->id; ?>" value="<?php echo $n->ds_nivel; ?>" />
                        </td>
                <input type="hidden" value="<?php echo $n->id; ?>" id="nivel_educativo<?php echo $i; ?>_id" />    
                <td>
                    <p class="no_edit_<?php echo $n->id; ?>" id="ley_educacion_no_edit_<?php echo $n->id; ?>"><?php echo $n->ley_educacion->ds_ley; ?> </p>
                    <select class="edit_<?php echo $n->id; ?> hidden" id="ley_educacion_<?php echo $n->id; ?>">
                        {ley}
                        <option value="{id}">{ds_ley}</option>
                        {/ley}
                    </select>
                    <script type="text/javascript">
                        planEstudioView.setSelectedIndexByValue('<?php echo $l; ?>', 'ley_educacion_<?php echo $n->id; ?>');
                    </script>
                </td>
                <td>
                    <p class="no_edit_<?php echo $n->id; ?>" id="dt_ini_no_edit_<?php echo $n->id; ?>"><?php echo $n->dt_ini_vig; ?> </p>
                    <input class="edit_<?php echo $n->id; ?> hidden"  type="date" id="dt_ini_<?php echo $n->id; ?>" value="<?php echo $n->dt_ini_vig; ?>" />
                </td>
                <td>
                    <p class="no_edit_<?php echo $n->id; ?>" id="dt_fin_no_edit_<?php echo $n->id; ?>"><?php echo $n->dt_fin_fic; ?> </p>
                    <input class="edit_<?php echo $n->id; ?> hidden"  type="date" id="dt_fin_<?php echo $n->id; ?>" value="<?php echo $n->dt_fin_fic; ?>" />
                </td>

                <td>
                    <div class="no_edit_<?php echo $n->id; ?> ">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Modificar" onclick="planEstudioView.show_editable(<?php echo $n->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="planEstudioView.delete_element('nivel_educativo',<?php echo $n->id; ?>,this);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                        </div>   
                    </div>
                    <div class="edit_<?php echo $n->id; ?> hidden">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Guardar" onclick="planEstudioView.edit_nivel_educativo(<?php echo $n->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="planEstudioView.hide_editable(<?php echo $n->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
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
                <li class="ui-state-default ui-corner-all" onclick="location.href = 'add_nivel_educativo';"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li> 
            </div>  
            <p style="padding-top: 5px;">Agregar Nuevo</p>
        </div>
    </div>
</div>