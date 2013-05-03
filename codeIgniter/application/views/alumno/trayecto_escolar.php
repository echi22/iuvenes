<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable2").tablesorter().tablesorterPager({container: $("#pager_trayecto_escolar")}); 
    } 
); 
</script>
<table class="content-center tablesorter" id="myTable2">
    <thead>
        <tr class="table_header">
            <th>Ciclo Lectivo</th><th>Nivel</th><th>Año</th><th>Sección</th><th>Orientación</th><th>Turno</th><th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $class = Array("odd", "even");
        foreach ($cursos as $i => $c) {
            ?>
            <tr class="<?php echo $class[($i % 2)]; ?>">
                <td><?php echo $c->id_ciclo_lectivo; ?></td>
                <td><?php echo $c->anio_nivel->nivel_educativo->ds_nivel; ?></td>
                <td>
                    <?php echo $c->anio_nivel->ds_anio; ?>
                </td>
                <td><?php echo $c->ds_seccion; ?></td>
                <td><?php echo $c->anio_nivel->orientation->ds_orientacion; ?></td>
                <td><?php echo $c->turno(); ?></td>                        
                <td> <div id="icons">
                        <a href="<?php echo base_url() . 'cursos/curso_data/' . $c->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                    </div> </td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<div style="clear: both"></div>
<?php
$pagerName = "pager_trayecto_escolar";
include('application/views/templates/pager.php');
?>
 