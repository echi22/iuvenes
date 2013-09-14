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
            Consulta Año Nivel
        </div>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Año</th><th>Nivel Educativo</th><th>Orientacion</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class = Array("odd", "even");
                foreach ($anio_nivel as $i => $a) {
                    ?>
                    <tr id="row_anio_nivel_<?php echo $a->id; ?>" class="<?php echo $class[($i % 2)]; ?>">
                        <td>
                            <p class="no_edit_<?php echo $a->id; ?>" id="anio_no_edit_<?php echo $a->id; ?>"><?php echo $a->ds_anio; ?> </p>
                            <input class="edit_<?php echo $a->id; ?> hidden" size="40" type="text" id="anio_<?php echo $a->id; ?>" value="<?php echo $a->ds_anio; ?>" />
                        </td>
                <input type="hidden" value="<?php echo $a->id; ?>" id="anio_nivel<?php echo $i; ?>_id" />    
                <td>
                    <p class="no_edit_<?php echo $a->id; ?>" id="nivel_educativo_no_edit_<?php echo $a->id; ?>"><?php echo $a->nivel_educativo->ds_nivel; ?> </p>
                    <select class="edit_<?php echo $a->id; ?> hidden" id="nivel_educativo_<?php echo $a->id; ?>">
                        {nivel_educativo}
                        <option value="{id}">{ds_nivel}</option>
                        {/nivel_educativo}
                    </select>
                    <script type="text/javascript">
                        planEstudioView.setSelectedIndexByValue('<?php echo $a->nivel_educativo->id; ?>', 'nivel_educativo_<?php echo $a->id; ?>');
                    </script>
                </td>
                <td>
                    <p class="no_edit_<?php echo $a->id; ?>" id="orientation_no_edit_<?php echo $a->id; ?>"><?php echo $a->orientation->ds_orientacion; ?> </p>
                    <select class="edit_<?php echo $a->id; ?> hidden" id="orientation_<?php echo $a->id; ?>">
                        {orientation}
                        <option value="{id}">{ds_orientacion}</option>
                        {/orientation}
                    </select>
                    <script type="text/javascript">
                        planEstudioView.setSelectedIndexByValue('<?php echo $a->orientation->id; ?>', 'orientation_<?php echo $a->id; ?>');
                    </script>
                </td>

                <td>
                    <div class="no_edit_<?php echo $a->id; ?> ">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Modificar" onclick="planEstudioView.show_editable(<?php echo $a->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="planEstudioView.delete_element('anio_nivel',<?php echo $a->id; ?>,this);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                        </div>   
                    </div>
                    <div class="edit_<?php echo $a->id; ?> hidden">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Guardar" onclick="planEstudioView.edit_anio_nivel(<?php echo $a->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="planEstudioView.hide_editable(<?php echo $a->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
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
                <li class="ui-state-default ui-corner-all" onclick="location.href = 'add_anio_nivel';"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li> 
            </div>  
            <p style="padding-top: 5px;">Agregar Nuevo</p>
        </div>
    </div>
</div>