<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">    
    <script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
    <script type="text/javascript">
        alumnosView = new AlumnosView();
    </script>
    <form id="form" action="<?php echo base_url() . 'alumnos/add_related_view'; ?>" method="post">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Agregar Familiar
            </div>
            <div class="row border_top border_bottom" style="vertical-align: bottom">
                <div class="input">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>"/>
                </div>
                <div class="input">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>"/>
                </div>
                <div class="input">
                    <label for="cd_identificacion">Tipo Identificación:</label>
                    <select id="cd_identificacion" name="cd_identificacion" >
                        <?php foreach ($identificacion as $i) { ?>
                            <option value="<?php echo $i->id; ?>"><?php echo $i->ds_identificacion; ?></option>
                        <?php } ?>
                    </select>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndexByValue('<?php echo $cd_identificacion; ?>','cd_identificacion');           
                    </script>
                </div>
                <div class="input">
                    <label for="ds_identificacion">Número:</label>
                    <input type="text" id="numero_identificacion" name="numero_identificacion" value="<?php echo $numero_identificacion; ?>" />
                </div>    
                <div class="input" style="padding-top: 20px">
                    <input type="hidden" value="si" name="busqueda"/>
                    <button onclick="form.submit()">Siguiente</button>
                </div>
            </div>
        </div>
    </form>

    <?php if (isset($personas)) { ?>
        <div class="content-center">
            Seleccione una persona existente de la siguiente lista o <a href="#" onclick="alumnosView.createRelative()">Cree una nueva persona</a>
        </div>
        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom content-center">

            <div>
                <table class="content-center tablesorter" id="myTable">
                    <thead>
                        <tr class="table_header">
                            <th>Nombre</th><th>Apellido</th><th>Identificación</th><th>Fecha de Nacimiento</th><th>Sexo</th><th></th>
                        </tr></thead>
                    <tbody>
                        <?php
                        $this->load->helper('url');
                        $class = Array('odd', 'even');
                        foreach ($personas as $i => $p) {
                            ?>
                            <tr class="<?php echo $class[($i % 2)]; ?>">
                                <td><?php echo $p->nombres; ?></td>
                                <td><?php echo $p->apellidos; ?></td>
                                <td><?php
                    foreach ($p->persona_identificacion as $identificacion) {
                        if ($identificacion->principal) {
                            echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion;
                        }
                    }
                            ?>                    
                                </td>
                                <td><?php echo $p->dt_nac; ?></td>
                                <td><?php echo $p->sexo->ds_sexo; ?></td>
                                <td>
                                    <input type="hidden" id="persona_id<?php echo $i; ?>" value="<?php echo $p->id; ?>" />
                                    <input type="hidden" name="persona<?php echo $i; ?>" value="<?php echo $p->nombres . ' ' . $p->apellidos; ?>" />
                                    <div id="icons">
                                        <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_identificacion" onclick="alumnosView.addRelative(<?php echo $i; ?>);"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                                    </div>              
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div style="clear: both"></div>
                <?php include('application/views/templates/pager.php'); ?>
            </div>
        <?php } ?> 

    </div>