<?php 
      echo validation_errors(); 
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
alumnosView = new AlumnosView();
function init(){
    alumnosView.setSelectedIndexByValue('<?php echo $alumno->persona->country_id; ?>','nacionalidad');
    alumnosView.setSelectedIndexByValue('<?php echo $alumno->persona->sexo_id; ?>','sexo');
    alumnosView.setSelectedIndexByValue('<?php echo $alumno->establecimiento_id; ?>','id_establecimiento');
}   
</script>
<div id="contenido">
    <form id="form" enctype="multipart/form-data" action="<?php echo base_url().'alumnos/modify/'.$alumno->persona->id; ?>" method="post">
        <input type="hidden" name="id_persona" value="<?php echo $alumno->persona->id; ?>" />
    <div id="insert_form" >        
        <div class="subtitle ">
            Datos Personales
        </div>
        <div class="row">
            <div class="input">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $alumno->persona->apellidos; ?>" class="required"/>
            </div>
            <div class="input">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" value="<?php echo $alumno->persona->nombres; ?>" name="nombres" class="required"/>
            </div>
           <div class="foto_container">
                        <img src="<?php echo base_url().$alumno->persona->foto; ?>" class="foto_alumno" alt="Foto del Alumno">
                    </div>
        </div>
        <div  id="identificaciones">
            <?php 
            $i = 0;
            if(count($alumno->persona->persona_identificacion->all) > 0){
                foreach ($alumno->persona->persona_identificacion as $identificacion){ ?>
                    <div id="identificacion" class="row">
                        <div class="input">
                            <label for="cd_identificacion">Tipo Identificación:</label>
                            <select id="identificacion_<?php echo $i; ?>" name="identificacion_<?php echo $i; ?>_[cd_identificacion]" class="required">
                                {identificacion}
                                <option value="{id}">{ds_identificacion}</option>
                                {/identificacion}
                            </select>
                        </div>
                        <div class="input">
                            <label for="ds_identificacion">Número:</label>
                            <input type="text" id="numero_identificacion" value="<?php echo $identificacion->numero_identificacion; ?>" name="identificacion_<?php echo $i; ?>_[numero_identificacion]" class="required"/>
                        </div>  
                    <?php if($i == 0){ ?>
                        <div class="input" id="icons">
                            <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_identificacion" onclick="alumnosView.addRow('identificacion','identificaciones');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                        </div>
                        <?php }else{ ?>
                        <div class="input" id="icons">
                            <li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow(this,'identificacion');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                        </div>
                    <?php } ?>
                    </div>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndexByValue('<?php echo $identificacion->widentificacion->id; ?>','identificacion_<?php echo $i; ?>');           
                    </script>
            <?php $i++;
            
                } 
             ?> <input type="hidden" id="cant_identificacion" name="cant_identificacion" value="<?php echo $i; ?>" />
          <?php
            }else{?>
                <div id="identificacion" class="row">
                    <div class="input">
                        <label for="cd_identificacion">Tipo Identificación:</label>
                        <select id="cd_identificacion" name="identificacion_0_[cd_identificacion]" class="required">
                            {identificacion}
                            <option value="{id}">{ds_identificacion}</option>
                            {/identificacion}
                        </select>
                    </div>
                    <div class="input">
                        <label for="ds_identificacion">Número:</label>
                        <input type="text" id="ds_identificacion" name="identificacion_0_[numero_identificacion]" class="required"/>
                    </div>     
                    <?php if($i == 0){?>
                    <div class="input" id="icons">
                        <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_identificacion" onclick="alumnosView.addRow('identificacion','identificaciones');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                    </div>
                    <?php }else{ ?>
                    <div class="input" id="icons">
                        <li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow(this,'identificacion');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                    </div>
                    <?php } ?>
                </div>
                <input type="hidden" name="cant_identificacion" value="1" />
                <script type="text/javascript">
                    alumnosView.setSelectedIndexByValue('<?php echo $dom->country->id; ?>','dom_pais_<?php echo $i; ?>');           
                </script>
        <?php } ?>
        </div>
        <div class="row">
            <div class="input">
                <label for="dt_nac">Fecha de Nacimiento:</label>
                <input type="date" name="dt_nac" id="dt_nac" value="<?php echo $alumno->persona->dt_nac; ?>" class="required"/>
            </div>
            <div class="input">
                <label for="nacionalidad">Nacionalidad:</label>
                <select name="nacionalidad" id="nacionalidad">
                    {nacionalidad}
                    <option value="{id}">{ds_pais}</option>
                    {/nacionalidad}
                </select>
            </div>
            <div class="input">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    {sexo}
                    <option value="{id}">
                        {ds_sexo}
                    </option>
                    {/sexo}
                </select>
            </div>
            <div class="input">
                <label for="id_establecimiento">Establecimiento:</label>                
                <select id="id_establecimiento" name="id_establecimiento">
                    {establecimiento}
                    <option value="{id_establecimiento}">{ds_establecimiento}</option>
                    {/establecimiento}
                </select>
            </div>            
        </div>
        <div class="row border_bottom">
            <div class="input">
                <label for="image">Foto:</label>
                <input type="file" name="image" id="image"/>
            </div>           
        </div>       
        <div class="subtitle">
            Domicilio 
        </div>
        <div id="domicilios">
            <?php 
                $i = 0;
                foreach($alumno->persona->domicilio as $dom){
            ?>
            <div id="domicilio">
                <div class="row">
                    <div class="input">
                        <label for="calle" >Calle:</label>
                        <input type="text" name="domicilio_<?php echo $i; ?>_[ds_calle]" value="<?php echo $dom->ds_calle; ?>" id="calle"/>
                    </div>
                    <div class="input">
                        <label for="num_casa">Número:</label>
                        <input type="number" name="domicilio_<?php echo $i; ?>_[ds_numeral]" value="<?php echo $dom->ds_numeral; ?>" id="num_casa"/>
                    </div>
                    <div class="input">
                        <label for="entre1">Entre:</label>
                        <input type="text"  name="domicilio_<?php echo $i; ?>_[ds_entre1]" value="<?php echo $dom->ds_entre1; ?>" id="entre1"/>
                    </div>
                    <div class="input">
                        <label for="ds_entre2"> y </label>
                        <input type="text" name="domicilio_<?php echo $i; ?>_[ds_entre2]" value="<?php echo $dom->ds_entre2; ?>"  id="entre2"/>
                    </div>
                     <?php if($i == 0){ ?>
                        <div class="input" id="icons">
                            <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_domicilio" onclick="alumnosView.addRow('domicilio','domicilios');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                        </div>
                    <?php }else{ ?>
                        <div class="input" id="icons">
                            <li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow(this,'domicilio');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                        </div>
                    <?php } ?>
                </div>
                <div class="row border_bottom">
                    <div class="input">                
                        <label for="piso">Piso:</label>
                        <input type="text" name="domicilio_<?php echo $i; ?>_[ds_piso]" value="<?php echo $dom->ds_piso; ?>" id="piso"/>
                    </div>
                    <div class="input">
                        <label for="depto">Depto:</label>
                        <input type="text" name="domicilio_<?php echo $i; ?>_[ds_depto]" value="<?php echo $dom->ds_depto; ?>" id="depto" />
                    </div>
                    <div class="input">
                        <label for="country">País:</label>
                        <select name="domicilio_<?php echo $i; ?>_[country]" id="dom_pais_<?php echo $i; ?>">
                            {country}
                            <option value="{id}">{ds_pais}</option>
                            {/country}
                        </select>
                    </div>
                    <div class="input">
                        <label for="provincia">Provincia:</label>
                        <select name="domicilio_<?php echo $i; ?>_[provincia]"  id="dom_provincia_<?php echo $i; ?>">
                            {provincia}
                            <option value="{id}">{ds_provincia}</option>
                            {/provincia}
                        </select>
                    </div>
                    <div class="input">
                        <label for="localidad">Localidad:</label>
                        <select id="localidad" name="domicilio_<?php echo $i; ?>_[localidad]"  id="dom_localidad_<?php echo $i; ?>">
                            {localidad}
                            <option value="{id}">{ds_localidad}</option>
                            {/localidad}
                        </select>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                alumnosView.setSelectedIndexByValue('<?php echo $dom->country->id; ?>','dom_pais_<?php echo $i; ?>');
//                alumnosView.setSelectedIndexByValue('<?php //echo $dom->ds_provincia->id; ?>','dom_provincia_<?php //echo $i; ?>');
//                alumnosView.setSelectedIndexByValue('<?php //echo $dom->ds_localidad->id; ?>','dom_localidad_<?php //echo $i; ?>');
//                
            </script>
            <?php $i++;} ?>
            <input type="hidden" id="cant_domicilio" name="cant_domicilio" value="<?php echo $i; ?>" />
        </div>
        <div class="subtitle">
            Teléfonos
        </div>
         <div id="telefonosContainer">
             <?php 
                $i=0;
                if(count($alumno->persona->telefono->all) > 0){
                    foreach ($alumno->persona->telefono as $telefono){ ?>
                        <div class="row" id="telefonoData"> 
                                <div class="div_input_chico">
                                    <input type="number" name="cod_area[]" id="cod_area" class="input_chico" value="<?php echo $telefono->nu_area; ?>">                 
                                </div>
                                <div class="input">
                                    <input type="number" name="telefono[]"  id="telefono" value="<?php echo $telefono->nu_tel; ?>" >                
                                </div>
                                <div class="input">
                                    <select id="tipo_telefono<?php echo $i; ?>" name="tipo_tel[]" >
                                        {telefono}
                                        <option value="{id}">{tipo_telefono}</option>
                                        {/telefono}
                                    </select>                
                                </div> 
                            <?php if($i == 0){ ?>
                                <div class="input" id="icons">
                                    <li class="ui-state-default ui-corner-all" title="Agregar" id="agregarTelefono" onclick="alumnosView.addPhone();"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                                </div>
                            <?php }else{ ?>
                                <div class="input" id="icons">
                                    <li class="ui-state-default ui-corner-all" title="Eliminar" id="eliminarTelefono" onclick="alumnosView.deletePhone(this);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                                </div>
                            <?php } ?>
                        </div>
                        <script type="text/javascript">
                            alumnosView.setSelectedIndexByValue('<?php echo $telefono->wtipo_telefono->tipo_telefono; ?>','tipo_telefono_<?php echo $i; ?>');
                        </script>
             <?php $i++;
             
                    }
                }else{?>
                    <div class="row" id="telefonoData"> 
                        <div class="div_input_chico">
                        <input type="number" name="cod_area[]" id="cod_area" class="input_chico" placeholder="Cod. Area" >                 
                        </div>
                        <div class="input">
                            <input type="number" name="telefono[]"  id="telefono" placeholder="Número" >                
                        </div>
                        <div class="input">
                            <select id="tipo_telefono" name="tipo_tel[]" >
                                {telefono}
                                <option value="{id}">{tipo_telefono}</option>
                                {/telefono}
                            </select>                
                        </div>               
                        <div class="input" id="icons">
                            <li class="ui-state-default ui-corner-all" title="Agregar" id="agregarTelefono" onclick="alumnosView.addPhone();"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                        </div>
                    </div>
            <?php } ?>
        </div>
                    
            <div class="row">
                <button onclick="alumnosView.submitForm()">Guardar</button>
            </div>
    </div>
    </form>
</div>        