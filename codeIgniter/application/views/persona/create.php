<?php 
      echo validation_errors(); 
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
alumnosView = new AlumnosView();
</script>

<div id="contenido">
    <?php echo form_open_multipart('personas/create/'.$popup);  ?>
    <div id="insert_form">
        <div class="titulo">
            Alta de Persona
        </div>
        <div class="subtitle border_top">
            Datos Personales
        </div>
        <div class="row">
            <div class="input">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="required"/>
            </div>
            <div class="input">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" class="required"/>
            </div>
            <div class="input">
                <label for="cd_identificacion">Tipo Identificación:</label>
                <select id="cd_identificacion" name="cd_identificacion" class="required">
                    {identificacion}
                    <option value="{id}">{ds_identificacion}</option>
                    {/identificacion}
                </select>
            </div>
            <div class="input">
                <label for="ds_identificacion">Número:</label>
                <input type="text" id="numero_identificacion" name="numero_identificacion" class="required"/>
            </div>                
        </div>
        <div class="row">
            <div class="input">
                <label for="dt_nac">Fecha de Nacimiento:</label>
                <input type="date" name="dt_nac" id="dt_nac" class="required"/>
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
                <label for="vive">Vive:</label>                
                <select id="vive" name="vive">
                    <option value="S">Si</option>
                    <option value="N">No</option>
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
        <div class="row">
            <div class="input">
                <label for="calle" >Calle:</label>
                <input type="text" name="ds_calle" id="calle"/>
            </div>
            <div class="input">
                <label for="num_casa">Número:</label>
                <input type="number" name="ds_numeral" id="num_casa"/>
            </div>
            <div class="input">
                <label for="entre1">Entre:</label>
                <input type="text"  name="ds_entre1" id="entre1"/>
            </div>
            <div class="input">
                <label for="ds_entre2"> y </label>
                <input type="text" name="ds_entre2"  id="entre2"/>
            </div>
        </div>
        <div class="row border_bottom">
            <div class="input">                
                <label for="piso">Piso:</label>
                <input type="text" name="ds_piso" id="piso"/>
            </div>
            <div class="input">
                <label for="depto">Depto:</label>
                <input type="text" name="ds_depto" id="depto" />
            </div>
            <div class="input">
                <label for="country">País:</label>
                <select name="country" id="country">
                    {country}
                    <option value="{id}">{ds_pais}</option>
                    {/country}
                </select>
            </div>
            <div class="input">
                <label for="provincia">Provincia:</label>
                <select name="provincia" id="provincia">
                    {provincia}
                    <option value="{id}">{ds_provincia}</option>
                    {/provincia}
                </select>
            </div>
            <div class="input">
                <label for="localidad">Localidad:</label>
                <select id="localidad" name="localidad">
                    {localidad}
                    <option value="{id}">{ds_localidad}</option>
                    {/localidad}
                </select>
            </div>
        </div>
        <div class="subtitle">
            Información Laboral
        </div>
        <div class="row border_bottom">
            <div class="input">
                <label for="estudios">Nivel de Estudios:</label>
                <select name="estudios" id="estudios">
                    <option value="Primario">Primario</option>
                    <option value="Secundario">Secundario</option>
                    <option value="Terciario">Terciario</option>
                    <option value="Universitario">Universitario</option>
                    
                </select>
            </div>
            <div class="input">
                <label for="profesion">Profesión</label>
                <input type="text" id="profesion" name="profesion"/>
            </div>
            <div class="input">
                <label for="ocupacion">Ocupación</label>
                <input type="text" id="ocupacion" name="ocupacion"/>
            </div>
        </div>
        <div class="subtitle">
            Teléfonos
        </div>
        <div class="row">
            <div class="div_input_chico">
                <input type="number"  id="cod_area" class="input_chico" placeholder="Cod. Area" > 
                <input type="hidden" name="cod_area" id="cod_area_hidden">
            </div>
            <div class="input">
                <input type="number"  id="telefono" placeholder="Número" >
                <input type="hidden" name="telefono" id="telefono_hidden">
            </div>
            <div class="input">
                <select id="tipo_telefono" >
                    {telefono}
                    <option value="{id}">{tipo_telefono}</option>
                    {/telefono}
                </select>
                <input type="hidden" name="tipo_tel" id="tipo_tel_hidden">
            </div>

            <div class="input">
                <button type="button" onclick="alumnosView.addPhone();">Agregar</button>
            </div>
        </div>
        
            <div class="telefono">
                <div class="div_input_chico">
                    Cod. Area
                </div>
                <div class="div_input_chico">
                    Número
                </div>
                <div class="div_input_chico">
                    Tipo
                </div>
            </div>
            <div id="telefonos"></div>
            <div class="row">
                <button onclick="alumnosView.sendPhones()">Guardar</button>
            </div>
        
        
        
    </div>
    </form>
</div>        