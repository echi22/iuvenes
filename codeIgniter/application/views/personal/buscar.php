<script type="text/javascript" src="<?php echo base_url(); ?>js/PersonalesView.js"></script>
<script type="text/javascript">
    personalesView = new PersonalesView();
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'personales/buscar'; ?>" method="post">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Busqueda de Personal
            </div>
            <div class="row border_top border_bottom" style="vertical-align: bottom">
                <div class="input">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?php echo $parametros['apellidos']; ?>" />
                </div>
                <div class="input">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" id="nombres" value="<?php echo $parametros['nombres']; ?>"/>
                </div>
                <div class="input">
                    <label for="cd_identificacion">Tipo Identificación:</label>
                    <select id="cd_identificacion" name="cd_identificacion" class="required">
                        <?php foreach ($identificacion as $i) { ?>
                            <option value="<?php echo $i->id; ?>"><?php echo $i->ds_identificacion; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input">
                    <label for="ds_identificacion">Número:</label>
                    <input type="text" id="numero_identificacion" name="numero_identificacion" class="required" value="<?php echo $parametros['numero_identificacion']; ?>"/>
                </div>    
                <div class="div_input_chico">
                    <label for="vigente">Estado:</label>
                    <select id="vigente" name="vigente">
                        <option value="1">Vigentes</option>
                        <option value="0">No Vigentes</option>
                        <option value="">Todos</option>
                    </select>
                </div>    
                <div class="input" style="padding-top: 20px">
                    <input type="hidden" value="si" name="busqueda"/>
                    <button onclick="form.submit()">Buscar</button>
                </div>
            </div>
    </form>
    <?php if (isset($personales)) { ?>
        <div class="row"style="width: 100%; margin: auto" >
            <table class="content-center tablesorter" id="myTable">
                <thead>
                    <tr class="table_header">
                        <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Fecha de Nacimiento</th><th>Nacionalidad</th><th>Estado</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array('odd', 'even');

                    foreach ($personales as $i => $a) {
                        ?>
                        <tr class="<?php echo $class[($i % 2)]; ?>">
                            <td><?php echo $a->persona->apellidos; ?></td>
                            <td><?php echo $a->persona->nombres; ?></td>
                            <td>
                                <?php
                                foreach ($a->persona->persona_identificacion as $identificacion) {
                                    if ($identificacion->principal) {
                                        ?>                   
                                        <?php echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion; ?></br>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo $a->persona->dt_nac; ?></td>
                            <td><?php echo $a->persona->country->ds_pais; ?></td>
                            <td class="estado" id="estado<?php echo $a->id; ?>"><?php echo $a->isVigente(); ?></td>
                            <td> <div id="icons">
                                    <a href="<?php echo base_url() . 'personales/personal_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                                    <li class="ui-state-default ui-corner-all" title="Cambiar vigente" onclick="personalesView.changeVigente(<?php echo $a->id; ?>,this)"><span class="ui-icon ui-icon-transferthick-e-w" style="margin: 0 4px;"></span></li>
                                </div> </td>
                        </tr>
                    <?php } ?>
                <tbody>
            </table>
            <div style="clear: both"></div>
            <?php include('application/views/templates/pager.php'); ?>
        </div>
    <?php } ?> 

</div>