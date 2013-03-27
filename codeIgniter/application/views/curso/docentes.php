<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    
    $(document).ready(function() 
    { 
        cursosView.actualizarPrestaciones($("#prestaciones"));
        $( "#tabs-docentes" ).tabs();

        $("#docentes").tablesorter().tablesorterPager({container: $("#pager_docentes")}); 
    }); 

</script>
<div id="tabs-docentes" style="width: 100%">
    <ul>
        <li><a href="#tabs-docentes-1">Listado Prestaciones</a></li>
        <li><a href="#tabs-docentes-2">Agregar Nuevas</a></li>
    </ul>
    <div id="tabs-docentes-2">
        <form name="form2"  action="<?php echo base_url() . 'cursos/save_prestaciones/' . $curso->id; ?>" id="form2" method="post">    

            <div >
                <div class="subtitle">
                    Prestaciones:
                </div>
                <div class="row" style="display: none;">
                    <div class="columna_ajustada">

                        <select id="años_cursos">
                            {años_cursos}
                            <option value="{id_ciclo_lectivo}">{id_ciclo_lectivo}</option>
                            {/años_cursos}
                        </select>

                    </div>
                    <div class="columna_ajustada">

                        <select id="cursos" onchange="cursosView.actualizarAlumnos(this,$('#alumnos'))">

                        </select>
                    </div>
                </div>
            </div>
            <div >
                <div class="columna_ajustada">
                    <div class="columna_ajustada">

                        <select multiple="true" id="prestaciones" name="prestaciones" class="multiple_select_box select_box_alumnos">
                            <?php
                            foreach ($prestaciones as $prestacion) {
                                $identificacion = $prestacion->personal->get_identificacion_principal();
                                ?>

                                <option value="<?php echo $prestacion->id; ?>">
                                    <?php echo $prestacion->cargo->ds_cargo . " " . $prestacion->personal->persona->apellidos . " " . $prestacion->personal->persona->nombres . " - " . $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion; ?>
                                </option>
                            <?php } ?>   
                        </select>
                        <div style="clear: both"></div>
                        <label for="filtro_alumno" style="display: inline">Nombre o DNI:</label><input id="filtro_prestacion" type="text" onkeyup="cursosView.actualizarPrestaciones($('#prestaciones'))" onchange="cursosView.actualizarPrestaciones($('#prestaciones'))">

                    </div>
                    <div class="columna_ajustada valign-middle">
                        <input type="button" onclick="cursosView.selectMoveRows(document.getElementById('prestaciones'),document.getElementById('prestaciones_seleccionadas'),cursosView.prestacionesSelected,cursosView.listadoPrestaciones)" value="Agregar >>" style="display: block;"/>
                        <input type="button" onclick="cursosView.selectMoveRows(document.getElementById('prestaciones_seleccionadas'),document.getElementById('prestaciones'),cursosView.prestacionesSelected,cursosView.listadoPrestaciones)" value="<< Quitar" style="display: block;"/>
                    </div>
                </div>
                <div class="columna_ajustada">

                    <select multiple="true" name="prestaciones_seleccionadas[]" id="prestaciones_seleccionadas" class="multiple_select_box select_box_alumnos">

                    </select>
                </div>
            </div>      
            <div style="clear: both"></div>
            <div class="row">
                <button onclick="cursosView.selectAllOptionsFromSelectbox('prestaciones_seleccionadas');return cursosView.submitForm('form2',true)">Guardar</button>
            </div>
        </form>
    </div>
    <div id="tabs-docentes-1">

        <table id="myTable" class="table_data tablesorter">
            <thead>
                <tr class="table_header">
                    <th>Apellido</th> <th>Nombre</th><th>Nombre Cargo</th> <th>Establecimiento</th> <th>Inicio Vigencia</th> <th>Fin Vigencia</th>
                    <th>Estado</th> <th>Carga Horaria</th> <th>Secuencia</th><th>Liq. Sueldo</th> <th>Sit. Revista</th>
                    <th>Asig. Familiar</th><th>% Asig. Familiar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $classes = Array("odd", "even");
                $i = 0;
                foreach ($curso->prestacions as $prestacion) {
                    ?>            
                    <tr class="<?php echo $classes[($i % 2)]; ?> prestacion" id="prestacion<?php echo $i; ?>">
                <input type="hidden" value="<?php echo $prestacion->id; ?>" id="prestacion<?php echo $i; ?>_id" />
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="apellidos<?php echo $prestacion->id; ?>"><?php echo $prestacion->personal->persona->apellidos; ?> </p>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="nombres<?php echo $prestacion->id; ?>"><?php echo $prestacion->personal->persona->nombres; ?> </p>
                </td>
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
                        cursosView.setSelectedIndex('<?php echo $prestacion->cargo->ds_cargo; ?>','cargo_<?php echo $prestacion->id; ?>');
                    </script>
                </td>
                <td>-<?php // echo $prestacion->establecimiento->ds_establecimiento;            ?>
                    <select class="edit_<?php echo $prestacion->id; ?>" id="id_establecimiento_<?php echo $prestacion->id; ?>" >
                        {establecimiento}
                        <option value="{id_establecimiento}">{ds_establecimiento}</option>
                        {/establecimiento}
                    </select>
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
                        cursosView.setSelectedIndex('<?php echo $prestacion->estado; ?>','estado_no_edit_<?php echo $prestacion->id; ?>');
                    </script>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="carga_horaria_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->qt_horas; ?></p>
                    <input class="edit_<?php echo $prestacion->id; ?> hidden" size="5" type="text" id="carga_horaria_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->qt_horas; ?>" class="required"/>
                </td>
                <td>
                    <p class="no_edit_<?php echo $prestacion->id; ?>" id="nu_secuencia_no_edit_<?php echo $prestacion->id; ?>"><?php echo $prestacion->nu_secuencia; ?></p>
                    <input type="text" class="edit_<?php echo $prestacion->id; ?> hidden" size="5"  id="nu_secuencia_<?php echo $prestacion->id; ?>" value="<?php echo $prestacion->nu_secuencia; ?>" class="required"/>
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
                        cursosView.setSelectedIndex('<?php echo $prestacion->tipo_liquidacion_sueldo->detalle; ?>','tp_liq_sueldo_<?php echo $prestacion->id; ?>');
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
                        cursosView.setSelectedIndex('<?php echo $prestacion->wsituacion_revista->ds_sit_revista; ?>','revista_<?php echo $prestacion->id; ?>');
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
                    <div class="no_edit_<?php echo $prestacion->id; ?> "> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="cursosView.deletePrestacion(this,<?php echo $prestacion->id; ?>,<?php echo $curso->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
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
        <div>
            <?php
            $pagerName = "pager_doncentes";
            include('application/views/templates/pager.php');
            ?>
        </div>
    </div>
</div>