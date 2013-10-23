<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div >
    <table id="myTable" class="table_data tablesorter">
        <thead>
            <tr class="table_header">
                <th>Fecha Inicio</th> <th>Fecha Fin</th> <th>Tipo</th> <th>Prestaciones Afectadas</th>               
            </tr>
        </thead>
        <tbody>
            <?php
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($personal->personal_licencia as $licencia) {
                ?>            
                <tr class="<?php echo $classes[($i % 2)]; ?> licencia" id="licencia<?php echo $i; ?>">
            <input type="hidden" value="<?php echo $licencia->id; ?>" id="licencia<?php echo $i; ?>_id" />                  
            <td>
                <p class="no_edit_<?php echo $licencia->id; ?>" id="dt_inicio_no_edit_<?php echo $licencia->id; ?>"><?php echo date_format(date_create($licencia->dt_inicio), 'd-m-Y');  ?> </p>
                <input class="edit_<?php echo $licencia->id; ?> hidden" size="5" type="date" id="dt_inicio_<?php echo $licencia->id; ?>" value="<?php echo $licencia->dt_inicio; ?>" />
            </td>
            <td>
                <p class="no_edit_<?php echo $licencia->id; ?>" id="dt_fin_no_edit_<?php echo $licencia->id; ?>"><?php echo date_format(date_create($licencia->dt_fin), 'd-m-Y');  ?> </p>
                <input class="edit_<?php echo $licencia->id; ?> hidden" size="5" type="date" id="dt_fin_<?php echo $licencia->id; ?>" value="<?php echo $licencia->dt_fin; ?>" />
            </td>          
            <td>
                <p class="no_edit_<?php echo $licencia->id; ?>" id="tp_licencia_no_edit_<?php echo $licencia->id; ?>"><?php echo $licencia->getTipoLicencia()->detalle; ?></p>
                <select class="edit_<?php echo $licencia->id; ?> hidden"  id="tp_licencia_<?php echo $licencia->id; ?>">
                    <?php foreach ($tipo_licencia as $tl) { ?>
                        <option value="<?php echo $tl->id; ?>">
                            <?php echo $tl->detalle; ?>
                        </option>
                    <?php } ?>
                </select>
                <script type="text/javascript">
                    personalesView.setSelectedIndex('<?php echo $licencia->getTipoLicencia()->detalle; ?>','tp_licencia_<?php echo $licencia->id; ?>');
                </script>
            </td>
            <td>
                <?php
                $prestaciones = $licencia->getPrestaciones();
                ?>
                <ul>
                <?php
                foreach ($prestaciones as $key => $prestacion) {                             
                   echo"<li>".$prestacion->detalle()."</li>";                
                }
                ?>
                </ul>
            </td>
            <td>
                <div class="no_edit_<?php echo $licencia->id; ?> ">
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Modificar" onclick="personalesView.show_editable(<?php echo $licencia->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="personalesView.delete_licencia(this,<?php echo $licencia->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                    </div>    
                </div>
                <div class="edit_<?php echo $licencia->id; ?> hidden">
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Guardar" onclick="personalesView.edit_licencia(<?php echo $licencia->id; ?>,<?php echo $personal->persona->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="personalesView.hide_editable(<?php echo $licencia->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
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

</div>
<div style="clear: both"></div>
<?php include('application/views/templates/pager.php'); ?>
<div>
<input type="hidden" id="cant_licencias" value="<?php echo $i; ?>" />
<a href="<?php echo base_url(); ?>personales/addLicencia/<?php echo $personal->persona->id; ?>">
    <button>Nueva Licencia</button></a>
</div>


