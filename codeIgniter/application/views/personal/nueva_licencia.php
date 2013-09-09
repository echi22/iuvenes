<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/PersonalesView.js"></script>
<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
    });
    personalesView = new PersonalesView();

</script>
<div class="titulo">
    Personal - <?php echo $personal->persona->apellidos . " " . $personal->persona->nombres; ?>
</div>

<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#tabs-1">Nueva Licencia</a></li>
    </ul>
    <div id="tabs-1">
<?php echo form_open_multipart('personales/addLicencia/' . $persona_id); ?>
        <div id="insert_form" >        
            <div class="row">            
                <div class="input">
                    <input type="hidden"  name="persona_id" value="<?php echo $persona_id; ?>" />
                    <label for="dt_inicio">Fecha Inicio:</label>
                    <input type="date" name="dt_inicio" id="dt_inicio" />
                </div>
                <div class="input">
                    <label for="cant_dias">Cantidad de Días:</label>
                    <input type="text" name="cant_dias" id="cant_dias" onkeyup="personalesView.addDays('dt_inicio', this.value, 'dt_fin')" />
                </div>
                <div class="input">
                    <label for="dt_fin">Fecha fin:</label>
                    <input type="date" name="dt_fin" id="dt_fin" onchange="personalesView.getDiffDays('dt_inicio', 'dt_fin', 'cant_dias')"/>
                </div>  
                <div class="input">
                    <label for="tp_liq_sueldo">Tipo:</label>
                    <select name="tipo_licencia" id="tipo_licencia">
                            <?php foreach ($tipo_licencia as $tl) { ?>
                            <option value="<?php echo $tl->id; ?>">
                            <?php echo $tl->detalle; ?>
                            </option>
<?php } ?>
                    </select>
                </div>                        
            </div>   
            <div >
                <table id="myTable" class="table_data tablesorter">
                    <thead>
                        <tr class="table_header">
                            <th>Nombre Cargo</th>  <th>Inicio Vigencia</th> <th>Fin Vigencia</th>
                            <th>Estado</th> <th>Carga Horaria</th> <th>Secuencia</th><th>Liq. Sueldo</th> <th>Sit. Revista</th>
                            <th>Asig. Familiar</th><th>% Asig. Familiar</th><td> <input id="p" type="checkbox" onclick="personalesView.selectAllCheckboxes('prestacion',this.checked)"/>Todas
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $classes = Array("odd", "even");
                        $i = 0;
                        foreach ($personal->prestacion as $prestacion) {
                            ?>            
                            <tr class="<?php echo $classes[($i % 2)]; ?> prestacion" id="prestacion<?php echo $i; ?>">
                        <input type="hidden" value="<?php echo $prestacion->id; ?>" id="prestacion<?php echo $i; ?>_id" />
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="cargo_no_edit_<?php echo $prestacion->id; ?>" ><?php echo $prestacion->cargo->ds_cargo; ?></p>
                            <select  id="cargo_<?php echo $prestacion->id; ?>"  class="edit_<?php echo $prestacion->id; ?> hidden">
                                    <?php foreach ($cargo as $c) { ?>
                                    <option value="<?php echo $c->id; ?>">
                                    <?php echo $c->ds_cargo; ?>
                                    </option>
    <?php } ?>
                            </select>
                            <script type="text/javascript">
        personalesView.setSelectedIndex('<?php echo $prestacion->cargo->ds_cargo; ?>', 'cargo_<?php echo $prestacion->id; ?>');
                            </script>
                        </td>                        
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="dt_inicio_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->dt_inicio; ?> </p>
                            <input class="edit_<?php echo $prestacion->id; ?> hidden" size="5" type="date" id="dt_inicio_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->dt_inicio; ?>" />
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="dt_fin_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->dt_fin; ?> </p>
                            <input class="edit_<?php echo $prestacion->id; ?> hidden" size="5" type="date" id="dt_fin_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->dt_fin; ?>" />
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="estado_no_edit_<?php echo $prestacion->id; ?>"><?php echo ($prestacion->estado == 'S') ? 'Vigente' : 'No vigente'; ?></p>
                            <select id="estado_<?php echo $prestacion->id; ?>"  class="edit_<?php echo $prestacion->id; ?> hidden" name="estado">
                                <option value="S">Vigente</option>
                                <option value="N">No Vigente</option>
                            </select>
                            <script type="text/javascript">
                                personalesView.setSelectedIndex('<?php echo $prestacion->estado; ?>', 'estado_no_edit_<?php echo $prestacion->id; ?>');
                            </script>
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="carga_horaria_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->qt_horas; ?></p>
                            <input class="edit_<?php echo $prestacion->id; ?> hidden" size="5" type="text" id="carga_horaria_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->qt_horas; ?>" class="required" required/>
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="nu_secuencia_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->nu_secuencia; ?></p>
                            <input type="text" class="edit_<?php echo $prestacion->id; ?> hidden" size="5"  id="nu_secuencia_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->nu_secuencia; ?>" class="required" required/>
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="tp_liq_sueldo_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->tipo_liquidacion_sueldo->detalle; ?></p>
                            <select class="edit_<?php echo $prestacion->id; ?> hidden"  id="tp_liq_sueldo_<?php echo $prestacion->id; ?>">
                                    <?php foreach ($liquidacion_sueldo as $tp) { ?>
                                    <option value="<?php echo $tp->id; ?>">
                                    <?php echo $tp->detalle; ?>
                                    </option>
    <?php } ?>
                            </select>
                            <script type="text/javascript">
                                personalesView.setSelectedIndex('<?php echo $prestacion->tipo_liquidacion_sueldo->detalle; ?>', 'tp_liq_sueldo_<?php echo $prestacion->id; ?>');
                            </script>
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="revista_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->wsituacion_revista->ds_sit_revista; ?></p>
                            <select id="revista_<?php echo $prestacion->id; ?>"  class="edit_<?php echo $prestacion->id; ?> hidden">
                                    <?php foreach ($wsituacion_revista as $rev) { ?>
                                    <option value="<?php echo $rev->id; ?>">
                                    <?php echo $rev->ds_sit_revista; ?>
                                    </option>
    <?php } ?>
                            </select>
                            <script type="text/javascript">
                                personalesView.setSelectedIndex('<?php echo $prestacion->wsituacion_revista->ds_sit_revista; ?>', 'revista_<?php echo $prestacion->id; ?>');
                            </script>
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="asig_familiar_no_edit_<?php echo $prestacion->id; ?>"><?php echo ($prestacion->asig_familiar) ? 'Sí' : 'No'; ?></p>
                            <input type="checkbox" id="asig_familiar_<?php echo $prestacion->id; ?>"   class="hidden edit_<?php echo $prestacion->id; ?>" value="<?php echo ($prestacion->asig_familiar) ? 'Sí' : 'No'; ?>"/>                        
                        </td>
                        <td>
                            <p class="no_edit_<?php echo $prestacion->id; ?>" id="porc_asig_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->porc_asig_familiar; ?></p>
                            <input type="text" id="porc_asig_familiar_<?php echo $prestacion->id; ?>" size="5" class="hidden edit_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->porc_asig_familiar; ?>"/>

                        </td>
                        <td>
                            <input type="checkbox" name="prestacion[<?php echo $prestacion->id; ?>]" class="prestacion"/>
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
            <div class="row">
                <button onclick="personalesView.submitForm()">Guardar</button>
                <button onclick=" return personalesView.goBack();" >Volver</button>

            </div>
        </div>
        </form>
    </div>
</div>


