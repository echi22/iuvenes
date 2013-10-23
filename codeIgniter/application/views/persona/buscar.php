<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>

<script type="text/javascript">
    alumnosView = new AlumnosView();
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter();
        alumnosView.setUpPaginator("pager");
    } 
); 
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'personas/buscar'; ?>" method="post">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Búsqueda de Personas
            </div>
            <div class="row border_top border_bottom" style="vertical-align: bottom">
                <div class="input">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?php echo $parametros['apellidos']; ?>" />
                </div>
                <div class="input">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" id="nombres" value="<?php echo $parametros['nombres']; ?>" />
                </div>
                <div class="input">
                    <label for="cd_identificacion">Tipo Identificación:</label>
                    <select id="cd_identificacion" name="cd_identificacion" >
                        <?php foreach ($identificacion as $i) { ?>
                            <option value="<?php echo $i->id; ?>"><?php echo $i->ds_identificacion; ?></option>
                        <?php } ?>
                    </select>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndexByValue('<?php echo $parametros[cd_identificacion]; ?>', 'cd_identificacion');
                    </script>
                </div>
                <div class="input">
                    <label for="ds_identificacion">Número:</label>
                    <input type="text" id="numero_identificacion" name="numero_identificacion" value="<?php echo $parametros['numero_identificacion']; ?>" />
                </div>    
                <div class="input" style="padding-top: 20px">
                    <input type="hidden" value="si" name="busqueda"/>
                     <input type="hidden" value="<?php if(isset($page)){echo $page;}else{echo 1; } ?>" name="page" id="page"/>
                    <input type="hidden" value="<?php if(isset($last_page)){echo $last_page;}else{echo 1; } ?>" name="last_page" id="last_page"/>

                    <button onclick="alumnosView.submitForm('form')">Buscar</button>
                </div>
            </div>
        </div>
    </form>
    <?php if (isset($personas)) { ?>
        <div style="width:90%; margin: auto;">
            <table id="myTable" class="tablesorter">
                <thead>
                    <tr class="table_header">
                        <th>Apellido</th><th>Nombre</th><th>Identificación</th><th>Fecha de Nacimiento</th><th>Sexo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $this->load->helper('url');
                    $i = 0;
                    foreach ($personas as $p) {
                        $i++;
                        ?>
                        <tr>                            
                            <td><?php echo $p->apellidos; ?></td>
                            <td><?php echo $p->nombres; ?></td>
                            <td><?php
                foreach ($p->persona_identificacion as $identificacion) {
                    if ($identificacion->principal) {
                        echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion;
                    }
                }
                        ?>                    
                            </td>
                            <td><?php echo date_format(date_create($p->dt_nac), 'd-m-Y') ; ?></td>
                            <td><?php echo $p->sexo->ds_sexo; ?></td>
                            <td>
                                <input type="hidden" id="persona_id<?php echo $i; ?>" value="<?php echo $p->id; ?>" />
                                <input type="hidden" name="persona<?php echo $i; ?>" value="<?php echo $p->nombres . ' ' . $p->apellidos; ?>" />
                                <div id="icons">
                                    <a href="<?php echo base_url() . 'personas/persona_data/' . $p->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>

                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div style="clear: both"></div>
            <?php include('application/views/templates/pager.php'); ?>
        <?php } ?> 

    </div>