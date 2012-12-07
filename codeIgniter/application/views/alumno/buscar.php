<div id="contenido">
    <form id="form" action="<?php echo base_url().'alumnos/buscar'; ?>" method="post">
    <div id="insert_form" class="content-center">
        <div class="titulo">
            Busqueda de Alumnos
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
    <?php if(isset($alumnos)){ ?>
    <div class="row"style="width: 90%; margin: auto" >
    <table>
        <tr class="table_header">
            <td>Apellidos</td><td>Nombres</td><td>Identificación</td><td>Fecha de Nacimiento</td><td>Nacionalidad</td><tD></td>
        </tr>
        <?php 
        $class="table_row2";
        
        foreach ($alumnos as $a){
            if($class == "table_row2")
                $class= "table_row1";
            else
                $class="table_row2";
            ?>
        <tr class="<?php echo $class; ?>">
            <td><?php echo $a->persona->apellidos; ?></td>
            <td><?php echo $a->persona->nombres; ?></td>
            <?php foreach ($a->persona->persona_identificacion as $identificacion){
                if($identificacion->principal){
            ?>                   
            <td> <?php  echo $identificacion->widentificacion->ds_identificacion." ".$identificacion->numero_identificacion; ?></td>
           <?php }} ?>
            <td><?php echo $a->persona->dt_nac; ?></td>
            <td><?php echo $a->persona->country->ds_pais; ?></td>
            <td><a href="<?php echo base_url().'alumnos/alumno_data/'.$a->persona->id; ?>">Ver mas</a></td>
        </tr>
        <?php } ?>
    </table>
    </div>
    <?php }?> 
        
</div>