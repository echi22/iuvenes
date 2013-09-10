<script type="text/javascript" src="<?php echo base_url(); ?>js/PlanEstudioView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">
    <div id="insert_form" class="content-center">
        <div class="titulo">
            Consulta Ley de Educación
        </div>
        <table class="content-center tablesorter" id="myTable">
            <thead>
                <tr class="table_header">
                    <th>Ley</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Vigente</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class = Array("odd", "even");
                foreach ($ley as $i => $l) {
                    ?>
                    <tr class="<?php echo $class[($i % 2)]; ?>">
                        <td><?php echo $l->ds_ley; ?></td>
                        <td><?php echo $l->dt_ini_vig; ?></td>
                        <td><?php echo $l->dt_fin_vig; ?></td>

                        <td><?php echo ($l->in_vigente) ? "Vigente" : "No vigente"; ?></td>                                              
                        <td> <div id="icons">
                                <a href="<?php echo base_url() . 'plan_estudios/ley_educacion_Data/' . $l->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                            </div> </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div style="clear: both"></div>
        <?php include('application/views/templates/pager.php'); ?>
    </div>
</div>