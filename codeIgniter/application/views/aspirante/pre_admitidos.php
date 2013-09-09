<script type="text/javascript">
    $(document).ready(function()
    {
        $("#fase1").tablesorter();
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
        aspiranteView.showAspirantesFromFase(1, true);
    }
    );
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'aspirantes/preadmitir_fase2'; ?>" method="post">        
        <div style="width:95%; margin: auto;">
            <div  >
                <span>Mostrar:</span>
                <select id="show_fase1" onchange="aspiranteView.showAspirantesFromFase(1, this.value);">
                    <option value="1">Aspirantes en fase 1</option>
                    <option value="0">Todos</option>
                </select>
            </div>
            <table class="content-center tablesorter fase_container" id="fase1">
                <thead>
                    <tr class="table_header">
                        <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Evaluacion Lengua</th><th>Evaluacion Matemática</th><th>Entrevista</th><th>Carta de Pre-Admisión</th><th>Fase Actual </th><th>Ver mas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array("odd", "even");
                    foreach ($fase1 as $i => $a) {
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
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_evaluacion1]" value="<?php echo $a->dt_evaluacion1; ?>" data-row="fase1_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_evaluacion2]" value="<?php echo $a->dt_evaluacion2; ?>" data-row="fase1_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_entrevista]" value="<?php echo $a->dt_entrevista; ?>" data-row="fase1_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <input type="date" name="aspirante[<?php echo $a->id; ?>][dt_carta]" value="<?php echo $a->dt_carta; ?>" data-row="fase1_<?php echo $a->id; ?>">
                            </td>
                            <td>
                                <?php echo $a->fase; ?>
                            </td>
                            <td> 
                                <input type="checkbox" style="display: none;" name="aspirante[<?php echo $a->id; ?>][changed]" id="fase1_<?php echo $a->id; ?>">

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
                                <input type="date" data-row="fase1_<?php echo $a->id; ?>" value="<?php echo $a->dt_evaluacion1; ?>" name="aspirante[<?php echo $a->id; ?>][dt_evaluacion1]">
                            </td>
                            <td>
                                <input type="date" data-row="fase1_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][dt_evaluacion2]" value="<?php echo $a->dt_evaluacion2; ?>">
                            </td>
                            <td>
                                <input type="date" data-row="fase1_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][dt_entrevista]" value="<?php echo $a->dt_entrevista; ?>">
                            </td>
                            <td>
                                <input type="date" data-row="fase1_<?php echo $a->id; ?>" name="aspirante[<?php echo $a->id; ?>][dt_carta]" value="<?php echo $a->dt_carta; ?>">
                            </td>
                            <td>
                                <?php echo $a->fase; ?>
                            </td>
                            <td> 
                                <input type="checkbox" style="display: none;" name="aspirante[<?php echo $a->id; ?>][changed]" id="fase1_<?php echo $a->id; ?>">
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