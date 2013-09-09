<script type="text/javascript">
    $(document).ready(function()
    {
        $("#fase3").tablesorter();

        $(".acordion").accordion({active: false,
            collapsible: true,
            heightStyle: "content"});
        aspiranteView.showAspirantesFromFase(3, true);

    }

    );
</script>
<div style="width: 100%">
    <form id="form" action="<?php echo base_url() . 'aspirantes/preadmitir_fase4'; ?>" method="post">  
        <div style="width:100%; margin: auto;">
            <div  >
                <span>Mostrar:</span>
                <select id="show_fase3" onchange="aspiranteView.showAspirantesFromFase(3, this.value);">
                    <option value="1">Aspirantes en fase 3</option>
                    <option value="0">Todos</option>
                </select>
            </div>
            <table class="content-center tablesorter fase_container" id="fase3">
                <thead>
                    <tr class="table_header">
                        <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Fecha Admisión</th><th>Fase Actual </th><th>Ver mas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array("odd", "even");
                    foreach ($fase3 as $i => $a) {
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
                                <input type="date" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][dt_admision]" value="<?php echo $a->dt_admision; ?>">
                            </td>
                            <td>
                                <?php echo $a->fase; ?>
                            </td>
                            <td> 
                                <input type="checkbox" style="display: none;" name="aspirante[<?php echo $a->id; ?>][changed]" id="fase3_<?php echo $a->id; ?>">

                                <div id="icons">
                                    <a href="<?php echo base_url() . 'aspirantes/aspirante_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                                </div> </td>

                        </tr>
                        <tr class="<?php echo $class[($i % 2)]; ?>">
                            <td colspan="5">
                                <div class="acordion">
                                    <h3>Documentación Requerida</h3>
                                    <div>
                                        <div class="row">
                                            <div style="width: 20%; float:left;">DNI <input type="checkbox" name="aspirante[<?php echo $a->id; ?>][dni]" data-row="fase3_<?php echo $a->id; ?>" <?php if ($a->documentacion->dni) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado de Bautismo <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_bautismo]" <?php if ($a->documentacion->cert_bautismo) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado de Nacimiento <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_nacimiento]" <?php if ($a->documentacion->cert_nacimiento) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado buena salud <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_buena_salud]" <?php if ($a->documentacion->cert_buena_salud) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado buco dental <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_buco_dental]" <?php if ($a->documentacion->cert_buco_dental) echo "checked"; ?>></div>
                                        </div>
                                        <div class="row">
                                            <div style="width: 20%; float:left;">Plan de vacunación <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][plan_vacunacion]" <?php if ($a->documentacion->plan_vacunacion) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Fotos carnet <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][fotos_carnet]" <?php if ($a->documentacion->fotos_carnet) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Solicitud inscripción <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][solicitud_inscripcion]" <?php if ($a->documentacion->solicitud_inscripcion) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Pago matrícula <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][pago_matricula]" <?php if ($a->documentacion->pago_matricula) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Solicitud reserva de vacante <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][reserva_vacante]" <?php if ($a->documentacion->reserva_vacante) echo "checked"; ?>></div>
                                        </div>


                                    </div>
                                </div>
                            </td>
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
                                <input type="date" data-row="fase3_<?php echo $a->id; ?>"  name="aspirante[<?php echo $a->id; ?>][dt_admision]" value="<?php echo $a->dt_admision; ?>">
                            </td>
                            <td>
                                <?php echo $a->fase; ?>
                            </td>
                            <td> 
                                <input type="checkbox" style="display: none;" name="aspirante[<?php echo $a->id; ?>][changed]" id="fase3_<?php echo $a->id; ?>">

                                <div id="icons">
                                    <a href="<?php echo base_url() . 'aspirantes/aspirante_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                                </div> </td>

                        </tr>
                        <tr class="<?php echo $class[($i % 2)]; ?> otra_fase">
                            <td colspan="5">
                                <div class="acordion">
                                    <h3>Documentación Requerida</h3>
                                    <div>
                                        <div class="row">
                                            <div style="width: 20%; float:left;">DNI <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][dni]" <?php if ($a->documentacion->dni) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado de Bautismo <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_bautismo]" <?php if ($a->documentacion->cert_bautismo) echo "checked"; ?>"></div>
                                            <div style="width: 20%; float:left;">Certificado de Nacimiento <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_nacimiento]" <?php if ($a->documentacion->cert_nacimiento) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado buena salud <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_buena_salud]" <?php if ($a->documentacion->cert_buena_salud) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Certificado buco dental <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][cert_buco_dental]" <?php if ($a->documentacion->cert_buco_dental) echo "checked"; ?>></div>
                                        </div>
                                        <div class="row">
                                            <div style="width: 20%; float:left;">Plan de vacunación <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][plan_vacunacion]" <?php if ($a->documentacion->plan_vacunacion) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Fotos carnet <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][fotos_carnet]" <?php if ($a->documentacion->fotos_carnet) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Solicitud inscripción <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][solicitud_inscripcion]" <?php if ($a->documentacion->solicitud_inscripcion) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Pago matrícula <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][pago_matricula]" <?php if ($a->documentacion->pago_matricula) echo "checked"; ?>></div>
                                            <div style="width: 20%; float:left;">Solicitud reserva de vacante <input type="checkbox" data-row="fase3_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][reserva_vacante]" <?php if ($a->documentacion->reserva_vacante) echo "checked"; ?>></div>
                                        </div>


                                    </div>
                                </div>
                            </td>
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