<div id="contenido">
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
    <form id="form" action="<?php echo base_url().'alumnos/add_related_view'; ?>" method="post">
        <div id="insert_form" class="content-center">
        <div class="titulo">
            Agregar Familiar
        </div>
        <div class="row border_top border_bottom" style="vertical-align: bottom">
            <div class="input">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" />
            </div>
            <div class="input">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" />
            </div>
            <div class="input">
                <label for="cd_identificacion">Tipo Identificación:</label>
                <select id="cd_identificacion" name="cd_identificacion" class="required">
                    <?php foreach ($identificacion as $i){ ?>
                    <option value="<?php echo $i->id; ?>"><?php echo $i->ds_identificacion; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input">
                <label for="ds_identificacion">Número:</label>
                <input type="text" id="numero_identificacion" name="numero_identificacion" class="required"/>
            </div>    
            <div class="input" style="padding-top: 20px">
                <input type="hidden" value="si" name="busqueda"/>
                <button onclick="form.submit()">Siguiente</button>
            </div>
        </div>
    </div>
    </form>
    
    <?php if(isset($personas)){ ?>
<div class="ui-tabs-panel ui-widget-content ui-corner-bottom content-center">
    <div>
        Seleccione una persona existente de la siguiente lista o <a href="<?php echo base_url(); ?>personas/create/true">Cree una nueva persona</a>
    </div>
    <div>
        <table class="content-center">
        <tr class="table_header">
            <td>Nombre</td><td>Apellido</td><td>Identificación</td><td>Fecha de Nacimiento</td><td>Sexo</td><td></td>
        </tr>
        <?php
            $this->load->helper('url');
            $i = 0;
            $class="table_row1";
            foreach($personas as $p){ 
            $i++;                         
        ?>
        <tr class="<?php echo $class; ?>">
            <td><?php echo $p->nombres; ?></td>
            <td><?php echo $p->apellidos; ?></td>
            <td><?php foreach ($p->persona_identificacion as $identificacion){
                            if($identificacion->principal){
                                echo $identificacion->widentificacion->ds_identificacion." ".$identificacion->numero_identificacion;
                            }
                          } ?>                    
            </td>
            <td><?php echo $p->dt_nac; ?></td>
            <td><?php echo $p->sexo->ds_sexo; ?></td>
            <td>
                <input type="hidden" id="persona_id<?php echo $i; ?>" value="<?php echo $p->id;?>" />
                <input type="hidden" name="persona<?php echo $i; ?>" value="<?php echo $p->nombres.' '.$p->apellidos; ?>" />
                <div id="icons">
                    <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_identificacion" onclick="alumnosView.addRelative(<?php echo $i; ?>);"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                </div>              
            </td>
            
        </tr>
        <?php 
            if($class=="table_row1")
                $class="table_row2";
            else
                $class = "table_row1";                
        } ?>
    </table>
    </div>
        <?php }?> 
         
</div>