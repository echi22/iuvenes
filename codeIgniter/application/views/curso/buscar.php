<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'cursos/buscar'; ?>" method="post">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Busqueda de Cursos
            </div>
            <div class="row ">
                <div class="input">
                    <label for="ciclo_lectivo">Ciclo Lectivo:</label>
                    <input type="text" id="ciclo_lectivo" name="id_ciclo_lectivo" class="required"/>
                </div>
                <div class="input">
                    <label for="year">Año:</label>
                    <input type="text" id="year" name="year" class="required"/>
                </div>

                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="nivel" name="nivel" class="required">
                        {nivel_educativo}
                        <option value="{id}">{ds_nivel}</option>
                        {/nivel_educativo}
                    </select>
                </div>
                <div class="input">
                    <label for="orientacion">Orientacion:</label>
                    <select id="orientacion" name="orientacion" class="required">
                        {orientacion}
                        <option value="{id}">{ds_orientacion}</option>
                        {/orientacion}
                    </select>
                </div>                      
</div>
            <div class="row border_bottom">
                <div class="input">
                    <label for="turno">Turno:</label>
                    <select name="cd_turno" id="turno" class="required">
                        <option value='m'>Mañana</option>
                        <option value='t'>Tarde</option>
                    </select>
                </div>
                <div class="input">
                    <label for="seccion">Sección:</label>
                    <input type="text" name="ds_seccion" id="seccion" class="required"/>
                </div>                       
            </div>     
            <div class="row" style="padding-top: 20px">
                <input type="hidden" value="si" name="busqueda"/>
                <button onclick="form.submit()">Buscar</button>
            </div>
            <div style="clear: both"></div>
    </form>
    <?php if (isset($cursos)) { ?>

        <table class="content-center tablesorter" id="myTable">
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
        <?php include('application/views/templates/pager.php'); ?>
    <?php } ?> 

</div>