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
                <th>Fecha</th> <th>Monto</th> <th>Tipo</th><th>Estado</th><th>Fecha de cobro</th> <th>Prestaciones Afectadas</th>               
            </tr>
        </thead>
        <tbody>
            <?php
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($personal->personal_adelanto as $adelanto) {
                ?>            
                <tr class="<?php echo $classes[($i % 2)]; ?> adelanto" id="adelanto<?php echo $i; ?>">
            <input type="hidden" value="<?php echo $adelanto->id; ?>" id="adelanto<?php echo $i; ?>_id" />                  
            <td>
                <p class="no_edit_<?php echo $adelanto->id; ?>" id="dt_adelanto_no_edit_<?php echo $adelanto->id; ?>"><?php echo $adelanto->dt_adelanto; ?> </p>
                <input class="edit_<?php echo $adelanto->id; ?> hidden" size="5" type="date" id="dt_adelanto_<?php echo $adelanto->id; ?>" value="<?php echo $adelanto->dt_adelanto; ?>" />
            </td>
            <td>
                <p class="no_edit_<?php echo $adelanto->id; ?>" id="monto_no_edit_<?php echo $adelanto->id; ?>"><?php echo $adelanto->monto; ?> </p>
                <input class="edit_<?php echo $adelanto->id; ?> hidden" size="5" type="text" id="monto_<?php echo $adelanto->id; ?>" value="<?php echo $adelanto->monto; ?>" />
            </td>          
            <td>
                <p class="no_edit_<?php echo $adelanto->id; ?>" id="tipo_adelanto_no_edit_<?php echo $adelanto->id; ?>"><?php echo $adelanto->tipo_adelanto->detalle; ?></p>
                <select class="edit_<?php echo $adelanto->id; ?> hidden"  id="tipo_adelanto_<?php echo $adelanto->id; ?>">
                    <?php foreach ($tipo_adelanto as $tl) { ?>
                        <option value="<?php echo $tl->id; ?>">
                            <?php echo $tl->detalle; ?>
                        </option>
                    <?php } ?>
                </select>
                <script type="text/javascript">
                    personalesView.setSelectedIndex('<?php echo $adelanto->tipo_adelanto->detalle; ?>','tp_adelanto_<?php echo $adelanto->id; ?>');
                </script>
            </td>
            <td>
                <p class="no_edit_<?php echo $adelanto->id; ?>" id="estado_adelanto_no_edit_<?php echo $adelanto->id; ?>"><?php echo $adelanto->estado_adelanto->detalle; ?></p>
                <select class="edit_<?php echo $adelanto->id; ?> hidden"  id="estado_adelanto_<?php echo $adelanto->id; ?>">
                    <?php foreach ($estado_adelanto as $ea) { ?>
                        <option value="<?php echo $ea->id; ?>">
                            <?php echo $ea->detalle; ?>
                        </option>
                    <?php } ?>
                </select>
                <script type="text/javascript">
                    personalesView.setSelectedIndex('<?php echo $adelanto->estado_adelanto->detalle; ?>','estado_adelanto_<?php echo $adelanto->id; ?>');
                </script>
            </td>
            <td>
                <p class="no_edit_<?php echo $adelanto->id; ?>" id="dt_cobro_no_edit_<?php echo $adelanto->id; ?>"><?php echo $adelanto->dt_cobro; ?> </p>
                <input class="edit_<?php echo $adelanto->id; ?> hidden" size="5" type="date" id="dt_cobro_<?php echo $adelanto->id; ?>" value="<?php echo $adelanto->dt_cobro; ?>" />
            </td>
            <td>
                <?php
                $prestaciones = $adelanto->getPrestaciones();
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
                <div class="no_edit_<?php echo $adelanto->id; ?> ">
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Modificar" onclick="personalesView.show_editable(<?php echo $adelanto->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="personalesView.delete_adelanto(this,<?php echo $adelanto->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                    </div>    
                </div>
                <div class="edit_<?php echo $adelanto->id; ?> hidden">
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Guardar" onclick="personalesView.edit_adelanto(<?php echo $adelanto->id; ?>,<?php echo $personal->persona->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="personalesView.hide_editable(<?php echo $adelanto->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
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
<input type="hidden" id="cant_adelantos" value="<?php echo $i; ?>" />
<a href="<?php echo base_url(); ?>personales/addAdelanto/<?php echo $personal->persona->id; ?>">
    <button>Nuevo Adelanto</button></a>
</div>


