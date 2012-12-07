<div id="contenido">
    <form id="form" action="<?php echo base_url().'personas/buscar'; ?>" method="post">
    <div id="insert_form" class="content-center">
        <div class="titulo">
            Busqueda de Personas
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
                <button onclick="form.submit()">Buscar</button>
            </div>
        </div>
    </div>
    </form>
    <?php if(isset($personas)){ ?>
    <div>
    <table>
        <tr class="table_header">
            <td>Nombre</td><td>Apellido</td><td>Identificación</td><td>Fecha de Nacimiento</td><td>Sexo</td>
        </tr>
        <?php
            $this->load->helper('url');
            $i = 0;
            foreach($personas as $p){ 
            $i++;
        ?>
        <tr>
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
                <a onclick="alumnosView.addRelative(<?php echo $i; ?>)">+</>
            </td>
            
        </tr>
        <?php } ?>
    </table>
    <?php }?> 
        
</div>