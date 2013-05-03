<?php session_start(); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/EstablecimientosView.js"></script>
<script type="text/javascript">
    establecimientosView = new EstablecimientosView(); 
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">
    <table id="myTable" class="table_data tablesorter">
        <thead>
            <tr class="table_header">
                <th>Establecimientos</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($establecimiento as $establecimiento) {
                if($establecimiento->id == $_SESSION['establecimiento_id'])
                    $c= " top row2 bottom ";
                else
                    $c = "";
                ?>            
                <tr class="<?php echo $classes[($i % 2)]; echo $c; ?> establecimiento" id="establecimiento<?php echo $i; ?>">
            <td>
                <p class="no_edit_<?php echo $establecimiento->id; ?>" id="ds_establecimiento_no_edit_<?php echo $establecimiento->id; ?>"><?php echo $establecimiento->ds_establecimiento; ?> </p>
                <input class="edit_<?php echo $establecimiento->id; ?> hidden" size="40" type="text" id="ds_establecimiento_<?php echo $establecimiento->id; ?>" value="<?php echo $establecimiento->ds_establecimiento; ?>" />
            </td>
            <input type="hidden" value="<?php echo $establecimiento->id; ?>" id="establecimiento<?php echo $i; ?>_id" />                  

            <td>
                <div class="no_edit_<?php echo $establecimiento->id; ?> ">
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Trabajar aquí" onclick="establecimientosView.work_here(this,<?php echo $establecimiento->id; ?>);"><span class="ui-icon ui-icon-arrowthick-1-e" style="margin: 0 4px;"></span></li>
                    </div>  
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Modificar" onclick="establecimientosView.show_editable(<?php echo $establecimiento->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="establecimientosView.delete_establecimiento(this,<?php echo $establecimiento->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                    </div>   
                </div>
                <div class="edit_<?php echo $establecimiento->id; ?> hidden">
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Guardar" onclick="establecimientosView.edit_establecimiento(<?php echo $establecimiento->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="establecimientosView.hide_editable(<?php echo $establecimiento->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                    </div>    
                </div>
            </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
    <div style="clear: both"></div>
    <?php include('application/views/templates/pager.php'); ?>
</div>