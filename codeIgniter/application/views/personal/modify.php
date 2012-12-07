<?php 
      echo validation_errors(); 
?>
<script type="text/javascript">
function init(){
    alumnosView.setSelectedIndexByValue('<?php echo $personal->persona->country_id; ?>','nacionalidad');
    alumnosView.setSelectedIndexByValue('<?php echo $personal->persona->sexo_id; ?>','sexo');
    alumnosView.setSelectedIndexByValue('<?php echo $personal->establecimiento_id; ?>','id_establecimiento');
}   
</script>

    <form id="form" enctype="multipart/form-data" action="<?php echo base_url().'personales/modify/'.$personal->persona->id; ?>" method="post">
        <input type="hidden" name="persona_id" value="<?php echo $personal->persona->id; ?>" />
    <div id="insert_form">
       
        <div class="subtitle ">
            Datos Personales
        </div>
        <div class="row">
            <div class="input">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $personal->persona->apellidos; ?>" class="required"/>
            </div>
            <div class="input">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" value="<?php echo $personal->persona->nombres; ?>" name="nombres" class="required"/>
            </div>
            <div class="input">
                <label for="cuil">CUIL:</label>
                <input type="text" id="cuil" value="<?php echo $personal->CUIL; ?>"  name="cuil" class="required"/>
            </div>
            <div class="input">
                <label for="mail">Mail:</label>
                <input type="email" id="mail" value="<?php echo $personal->persona->mail; ?>"  name="mail" class="required"/>
            </div>
            <div class="foto_container">
                        <img src="<?php echo base_url().$personal->persona->foto; ?>" class="foto_alumno" alt="Foto del Alumno">
                    </div>
        </div>
         <div  id="identificaciones">
            <?php 
            $i = 0;
            if(count($personal->persona->persona_identificacion->all) > 0){
                foreach ($personal->persona->persona_identificacion as $identificacion){ ?>
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
                <input type="date" name="dt_nac" id="dt_nac" value="<?php echo $personal->persona->dt_nac; ?>" class="required"/>
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
                <input type="file" name="image" id="image" />
            </div>           
        </div>       
        <div class="subtitle">
            Domicilio 
        </div>
        <div id="domicilios">
            <?php 
                $i = 0;
                foreach($personal->persona->domicilio as $dom){
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
                            <li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow('domicilio');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
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
            Estudios
        </div>
        <div  id="titulos" class="border_bottom">   
            <?php 
            if(count($personal->persona->titulo) > 0){
                $i = 0;
                foreach($personal->persona->titulo as $titulo){ ?>
                <div id="titulo" class="row">
                    <div class="input">
                        <label for="ds_titulo">Título</label>
                        <input type="text" id="ds_titulo" value="<?php echo $titulo->ds_titulo; ?>" name="titulo_0_[ds_titulo]" />
                    </div>
                    <div class="input">
                        <label for="dt_titulo">Fecha:</label>
                        <input type="date" id="dt_titulo" value="<?php echo $titulo->fecha; ?>" name="titulo_0_[fecha]"/>
                    </div>     
                    <div class="input">
                        <label for="institucion">Institución:</label>
                        <input type="text" id="institucion" value="<?php echo $titulo->institucion; ?>" name="titulo_0_[institucion]"/>
                    </div>  
                    
                    <div class="input" id="icons">
                        <?php if($i == 0){ ?>
                            <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_titulo" onclick="alumnosView.addRow('titulo','titulos');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                        <?php }else{ ?>
                            <li class="ui-state-default ui-corner-all" title="Eliminar" id="eliminar_titulo" onclick="alumnosView.deleteRow(this,'titulo');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>                            
                        <?php } ?>
                    </div>                    
                </div>
            <?php $i++; } ?>             <input type="hidden" id="cant_titulo" name="cant_titulo" value="<?php echo count($personal->persona->titulo); ?>" />      

        <?php }else{ ?>
                <div id="titulo" class="row">
                    <div class="input">
                        <label for="ds_titulo">Título</label>
                        <input type="text" id="ds_titulo" name="titulo_0_[ds_titulo]" />
                    </div>
                    <div class="input">
                        <label for="dt_titulo">Fecha:</label>
                        <input type="date" id="dt_titulo" name="titulo_0_[fecha]"/>
                    </div>     
                    <div class="input">
                        <label for="institucion">Institución:</label>
                        <input type="text" id="institucion" name="titulo_0_[institucion]"/>
                    </div>  
                    <div class="input" id="icons">
                        <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_titulo" onclick="alumnosView.addRow('titulo','titulos');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                    </div>                    
                </div>
                <input type="hidden" id="cant_titulo" name="cant_titulo" value="1" />             
            <?php } ?>
        </div>
        <div class="subtitle" >
            Teléfonos
        </div>
         <div id="telefonosContainer">
             <?php 
                $i=0;
                if(count($personal->persona->telefono->all) > 0){
                    foreach ($personal->persona->telefono as $telefono){ ?>
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