
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#fase2").tablesorter();
        $("#popup_vigente").dialog({
            autoOpen: false,
            show: {
                effect: "fade",
                duration: 1000
            },
            hide: {
                effect: "fade",
                duration: 1000
            }
        });
        aspiranteView.showAspirantesFromFase(2, true);

    }
    );
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'aspirantes/preadmitir_fase3'; ?>" method="post">  
        <div style="width:95%; margin: auto;">
            <div  >
                <span>Mostrar:</span>
                <select id="show_fase2" onchange="aspiranteView.showAspirantesFromFase(2, this.value);">
                    <option value="1">Aspirantes en fase 2</option>
                    <option value="0">Todos</option>
                </select>
            </div>
            <table class="content-center tablesorter fase_container" id="fase2">
                <thead>
                    <tr class="table_header">
                        <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Estado de deuda</th><th>Contrato de reserva de vacante</th><th>Pago de matrícula</th><th>Fase Actual </th><th>Ver mas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array("odd", "even");
                    foreach ($fase2 as $i => $a) {
                        ?>
                        <tr class="<?php echo $class[($i % 2)]; ?> alumno">
                            <td><?php echo $a->persona->apellidos; ?></td>
                            <td><?php echo $a->persona->nombres; ?></td>
                            <td>
                                <?php
                                $identificacion = $a->get_identificacion_principal();
                                echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion;
                                ?>
                            </td>
                            <td>
                                <select name="aspirante[<?php echo $a->id; ?>][estado_deuda]" id="estado_deuda_<?php echo $a->id; ?>" data-row="fase2_<?php echo $a->id; ?>">
                                    <option value="0">- Seleccione -</option>
                                    <option value="1">Adeuda</option>
                                    <option value="2">No Adeuda</option>
                                </select>
                                <script type="text/javascript">
                                    aspiranteView.setSelectedIndexByValue('<?php echo $a->estado_deuda; ?>', 'estado_deuda_<?php echo $a->id; ?>');
                                </script>
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_contrato_reserva]" value="<?php echo $a->dt_contrato_reserva; ?>" data-row="fase2_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_pago_matricula]" value="<?php echo $a->dt_pago_matricula; ?>" data-row="fase2_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <?php echo $a->fase; ?>
                            </td>
                            <td> 
                                <input type="checkbox" style="display: none;" name="aspirante[<?php echo $a->id; ?>][changed]" id="fase2_<?php echo $a->id; ?>">

                                <div id="icons">
                                    <a href="<?php echo base_url() . 'aspirantes/aspirante_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                                </div> </td>

                        </tr>
                        <?php
                    }
                    foreach ($aspirantes as $i => $a) {
                        ?>
                        <tr class="<?php echo $class[($i % 2)]; ?> alumno otra_fase">
                            <td><?php echo $a->persona->apellidos; ?></td>
                            <td><?php echo $a->persona->nombres; ?></td>
                            <td>
                                <?php
                                $identificacion = $a->get_identificacion_principal();
                                echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion;
                                ?>
                            </td>
                            <td>
                                <select name="aspirante[<?php echo $a->id; ?>][estado_deuda]" id="estado_deuda_<?php echo $a->id; ?>" data-row="fase2_<?php echo $a->id; ?>">
                                    <option value="0">- Seleccione -</option>
                                    <option value="1">Adeuda</option>
                                    <option value="2">No Adeuda</option>

                                </select>
                                <script type="text/javascript">
                                    aspiranteView.setSelectedIndexByValue('<?php echo $a->estado_deuda; ?>', 'estado_deuda_<?php echo $a->id; ?>');
                                </script>
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_contrato_reserva]"  value="<?php echo $a->dt_contrato_reserva; ?>" data-row="fase2_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_pago_matricula]" value="<?php echo $a->dt_pago_matricula; ?>" data-row="fase2_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <?php echo $a->fase; ?>
                            </td>
                            <td>
                                <input type="checkbox" style="display: none;" name="aspirante[<?php echo $a->id; ?>][changed]" id="fase2_<?php echo $a->id; ?>">
                                <div id="icons">
                                    <a href="<?php echo base_url() . 'aspirantes/aspirante_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                                </div> </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <button onclick="return aspiranteView.submitForm('form', true)">Guardar</button>
        </div>
        <div style="clear: both"></div>
</div>