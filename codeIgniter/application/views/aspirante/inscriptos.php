<script type="text/javascript">
    $(document).ready(function()
    {
        $("#myTable").tablesorter();
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
    }
    );
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'aspirantes/preadmitir_fase1'; ?>" method="post">

        <div style="width:90%; margin: auto;">
            <table class="content-center tablesorter" id="myTable">
                <thead>
                    <tr class="table_header">
                        <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Seleccionar</th><th>Ver mas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array("odd", "even");
                    foreach ($aspirantes as $i => $a) {
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
                                <input type="checkbox" name="aspirante[<?php echo $a->id; ?>]">
                            </td>
                            <td> <div id="icons">
                                    <a href="<?php echo base_url() . 'aspirantes/aspirante_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                                </div> </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row">
                <button onclick="return aspiranteView.submitForm('form', true)">Pre-Inscribir</button>
                <button onclick="return aspiranteView.submitForm('form', true, '<?php echo base_url() . 'aspirantes/no_admitir'; ?>')">No admitir</button>
            </div>
        </div>
        <div style="clear: both"></div>
</div>