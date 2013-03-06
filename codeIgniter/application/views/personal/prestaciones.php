<div class="row">
    <div class="input">
        <label for="estado" style="display: block;">Estado:</label>                        
        <select id="estado" name="estado" class="filtro_igual">
            <option value="S">Vigentes</option>
            <option value="N">No vigentes</option>
            <option value="">Todas</option>
        </select>
    </div>
    <div class="input_grande">
        <label for="id_establecimiento">Establecimiento:</label>                
        <select id="id_establecimiento" name="id_establecimiento" class="filtro_igual">
            {establecimiento}
            <option value="{id_establecimiento}">{ds_establecimiento}</option>
            {/establecimiento}
        </select>
    </div>    
    <div class="input">
        <label for="dt_inicio">Desde:</label>                
        <input type="date" id="dt_inicio" name="dt_inicio" class="filtro_mayor">
    </div>
    <div class="input">
        <label for="dt_fin">Hasta:</label>                
        <input type="date" id="dt_fin" name="dt_fin" class="filtro_menor">
    </div>    
</div>
<div >
        <table class="table_data">
            <tr class="table_header">
                <td>Nombre Cargo</td> <td>Establecimiento</td> <td>Inicio Vigencia</td> <td>Fin Vigencia</td>
                <td>Estado</td> <td>Carga Horaria</td> <td>Secuencia</td><td>Liq. Sueldo</td> <td>Sit. Revista</td>
                <td>Asig. Familiar</td><td>% Asig. Familiar</td>
            </tr>
            <?php 
                $class="table_row2";
                $i =0;
                foreach($personal->prestacion as $prestacion){
                   
                    if($class == "table_row1")
                            $class = "table_row2";
                        else
                            $class = "table_row1";
            ?>            
            <tr class="<?php echo $class; ?> prestacion" id="prestacion<?php echo $i;?>">
            <input type="hidden" value="<?php echo $prestacion->id;?>" id="prestacion<?php echo $i;?>_id" />
                <td>
                    <p class="no_edit_<?php echo $prestacion->id;?>" id="cargo_no_edit_<?php echo $prestacion->id;?>" ><?php echo $prestacion->cargo->ds_cargo; ?></p>
                    <select  id="cargo_<?php echo $prestacion->id;?>"  class="edit_<?php echo $prestacion->id;?> hidden">
                        <?php foreach ($cargo as $c){ ?>
                        <option value="<?php echo $c->id; ?>">
                            <?php echo $c->ds_cargo; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndex('<?php echo $prestacion->cargo->ds_cargo; ?>','cargo_<?php echo $prestacion->id;?>');
                    </script>
                </td>
                <td>-<?php // echo $prestacion->establecimiento->ds_establecimiento; ?>
                    <select class="edit_<?php echo $prestacion->id;?>" id="id_establecimiento_<?php echo $prestacion->id;?>" >
                        {establecimiento}
                        <option value="{id_establecimiento}">{ds_establecimiento}</option>
                        {/establecimiento}
                    </select>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id;?>" id="dt_inicio_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->dt_inicio; ?> </p>
                    <input class="edit_<?php echo $prestacion->id;?> hidden" size="5" type="date" id="dt_inicio_<?php echo $prestacion->id;?>" value="<?php echo $prestacion->dt_inicio; ?>" />
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id;?>" id="dt_fin_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->dt_fin; ?> </p>
                    <input class="edit_<?php echo $prestacion->id;?> hidden" size="5" type="date" id="dt_fin_<?php echo $prestacion->id;?>" value="<?php echo $prestacion->dt_fin; ?>" />
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id;?>" id="estado_no_edit_<?php echo $prestacion->id;?>"><?php echo ($prestacion->estado == 'S') ? 'Vigente' : 'No vigente'; ?></p>
                    <select id="estado_<?php echo $prestacion->id;?>"  class="edit_<?php echo $prestacion->id;?> hidden" name="estado">
                        <option value="S">Vigente</option>
                        <option value="N">No Vigente</option>
                    </select>
                     <script type="text/javascript">
                        alumnosView.setSelectedIndex('<?php echo $prestacion->estado; ?>','estado_no_edit_<?php echo $prestacion->id;?>');
                    </script>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="carga_horaria_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->qt_horas; ?></p>
                    <input class="edit_<?php echo $prestacion->id; ?> hidden" size="5" type="text" id="carga_horaria_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->qt_horas; ?>" class="required"/>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="nu_secuencia_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->nu_secuencia; ?></p>
                    <input type="text" class="edit_<?php echo $prestacion->id; ?> hidden" size="5"  id="nu_secuencia_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->nu_secuencia; ?>" class="required"/>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="tp_liq_sueldo_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->tipo_liquidacion_sueldo->detalle; ?></p>
                    <select class="edit_<?php echo $prestacion->id; ?> hidden"  id="tp_liq_sueldo_<?php echo $prestacion->id; ?>">
                        <?php foreach ($liquidacion_sueldo as $tp){ ?>
                        <option value="<?php echo $tp->id; ?>">
                            <?php echo $tp->detalle; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndex('<?php echo $prestacion->tipo_liquidacion_sueldo->detalle; ?>','tp_liq_sueldo_<?php echo $prestacion->id; ?>');
                    </script>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="revista_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->wsituacion_revista->ds_sit_revista; ?></p>
                    <select id="revista_<?php echo $prestacion->id; ?>"  class="edit_<?php echo $prestacion->id; ?> hidden">
                        <?php foreach ($wsituacion_revista as $rev){ ?>
                        <option value="<?php echo $rev->id; ?>">
                            <?php echo $rev->ds_sit_revista; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndex('<?php echo $prestacion->wsituacion_revista->ds_sit_revista; ?>','revista_<?php echo $prestacion->id; ?>');
                    </script>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="asig_familiar_no_edit_<?php echo $prestacion->id;?>"><?php echo ($prestacion->asig_familiar) ? 'Sí' : 'No'; ?></p>
                    <input type="checkbox" id="asig_familiar_<?php echo $prestacion->id; ?>"   class="hidden edit_<?php echo $prestacion->id; ?>" value="<?php echo ($prestacion->asig_familiar) ? 'Sí' : 'No'; ?>"/>                        
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="porc_asig_no_edit_<?php echo $prestacion->id;?>"><?php echo $prestacion->porc_asig_familiar; ?></p>
                    <input type="text" id="porc_asig_familiar_<?php echo $prestacion->id; ?>" size="5" class="hidden edit_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->porc_asig_familiar; ?>"/>

                </td>
                <td>
                    <div class="no_edit_<?php echo $prestacion->id; ?> ">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Modificar" onclick="alumnosView.show_editable(<?php echo $prestacion->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="alumnosView.deletePrestacion(this,<?php echo $prestacion->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                        </div>    
                    </div>
                    <div class="edit_<?php echo $prestacion->id; ?> hidden">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Guardar" onclick="alumnosView.edit_prestacion(<?php echo $prestacion->id; ?>,<?php echo $personal->persona->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="alumnosView.hide_editable(<?php echo $prestacion->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                        </div>    
                    </div>
                </td>
            </tr>
            <?php  $i++; } ?>
        </table>
    </div>
    <input type="hidden" id="cant_prestaciones" value="<?php echo $i;?>" />
    <a href="<?php echo base_url(); ?>/personales/add_prestacion/<?php echo $personal->persona->id; ?>">
        <button>Nueva Prestación</button>
    </div>


