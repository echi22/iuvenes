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


    <div style="width:90%; margin: auto;">
        <form id="form" action="<?php echo base_url() . 'aspirantes/get_all_from_year'; ?>" method="post">
            <input name="ciclo" value="<?php echo date('Y'); ?>" /> <input type="submit" value="Ver" />
        </form>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Estado</th><th>Fase Actual</th><th>Ver mas</th>
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
                            <?php
                            $e = new Estado_aspirante();
                            $e->where("id", $a->estado)->get();
                            echo $e->detalle;
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($e->detalle == "Pre-admitido") {
                                echo $a->fase;
                            }
                            ?>
                        </td>
                        <td> <div id="icons">
                                <a href="<?php echo base_url() . 'aspirantes/aspirante_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                            </div> </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <div style="clear: both"></div>
</div>