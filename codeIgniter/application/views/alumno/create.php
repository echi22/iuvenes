<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/imagePreview.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
    $(document).ready(function()
    {
        $('.image').preimage();

//        $("#persona_existente").autocomplete({
//            source: alumnosView.existingPersons
//        });
//        $("#apellidos").change(alumnosView.getExistingPersons);
//        $("#nombres").change(alumnosView.getExistingPersons);
//        $("#cd_identificacion").change(alumnosView.getExistingPersons);
//        $("#ds_identificacion").change(alumnosView.getExistingPersons);
    });
</script>
<style>
    .prev_container{
        overflow: auto;
        width: 200px;
        height: 250px;
    }

    .prev_thumb{
        margin: 10px;
        max-width: 200px;
        height: 200px;
    }
</style>
<div id="contenido">
    <form id="form" enctype="multipart/form-data" action="<?php echo base_url() . 'alumnos/create'; ?>" id="form" method="post">
        <?php echo form_open_multipart('alumnos/create'); ?>
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Alumno
            </div>
            <div class="subtitle border_top">
                Datos Personales
            </div>
            <div class="row">
                <div class="input">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="required" required/>
                </div>
                <div class="input">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" class="required" required/>
                </div>
                <div class="input">
                    <label for="apellidos">Seleccionar persona existente:</label>
                    <input type="text" id="persona_existente" name="persona_existente" />
                </div>
                <div id="prev_image" class="foto_container"></div><br/>
            </div>
            <div  class="row">
                <div class="input">
                    <label for="cd_identificacion">Tipo Identificación:</label>
                    <select id="cd_identificacion" name="identificacion_0_[cd_identificacion]" class="required cd_identificacion">
                        {identificacion}
                        <option value="{id}">{ds_identificacion}</option>
                        {/identificacion}
                    </select>
                </div>
                <div class="input">
                    <label for="ds_identificacion">Número:</label>
                    <input type="text" id="ds_identificacion" name="identificacion_0_[numero_identificacion]" class="required nu_identificacion"/>
                </div>          
                <input type="hidden" name="cant_identificacion" value="1" />

            </div>
            <div class="row">
                <div class="input">
                    <label for="dt_nac">Fecha de Nacimiento:</label>
                    <input type="date" name="dt_nac" id="dt_nac" class="required" required/>
                </div>
                <div class="input">
                    <label for="dt_ingreso">Fecha de Ingreso:</label>
                    <input type="date" name="dt_ingreso" id="dt_ingreso" value="<?php echo date('Y-m-d'); ?>" class="required" required/>
                </div>
                <div class="input">
                    <label for="nacionalidad">Nacionalidad:</label>
                    <select name="nacionalidad" id="nacionalidad" class="required" required>
                        {nacionalidad}
                        <option value="{id}">{ds_pais}</option>
                        {/nacionalidad}
                    </select>
                </div>
                <div class="input">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" class="required" required>                    
                        {sexo}
                        <option value="{id}">
                            {ds_sexo}
                        </option>
                        {/sexo}
                    </select>
                </div>
                <!--                <div class="input">
                                    <label for="id_establecimiento">Establecimiento:</label>                
                                    <select id="id_establecimiento" name="id_establecimiento">
                                        {establecimiento}
                                        <option value="{id_establecimiento}">{ds_establecimiento}</option>
                                        {/establecimiento}
                                    </select>
                                </div>            -->
            </div>
            <div class="row border_bottom">
                <div class="input">
                    <label for="image">Foto:</label>
                    <input type="file" name="image" id="image" class="image"/>

                </div>
            </div>
            <div class="subtitle">
                Teléfonos
            </div>
            <div id="telefonosContainer">
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
            </div>       
            <div class="subtitle">
                Domicilio
            </div>
            <div id="domicilios">
                <div id="domicilio">
                    <div class="row">
                        <div class="input">
                            <label for="calle" >Calle:</label>
                            <input type="text" name="domicilio_0_[ds_calle]" id="calle" class="required" required/>
                        </div>
                        <div class="input">
                            <label for="num_casa">Número:</label>
                            <input type="number" name="domicilio_0_[ds_numeral]" id="num_casa" class="required" required/>
                        </div>
                        <div class="input">
                            <label for="entre1">Entre:</label>
                            <input type="text"  name="domicilio_0_[ds_entre1]" id="entre1"/>
                        </div>
                        <div class="input">
                            <label for="ds_entre2"> y </label>
                            <input type="text" name="domicilio_0_[ds_entre2]"  id="entre2"/>
                        </div>
                    </div>
                    <div class="row border_bottom">
                        <div class="input">                
                            <label for="piso">Piso:</label>
                            <input type="text" name="domicilio_0_[ds_piso]" id="piso"/>
                        </div>
                        <div class="input">
                            <label for="depto">Depto:</label>
                            <input type="text" name="domicilio_0_[ds_depto]" id="depto" />
                        </div>
                        <div class="input">
                            <label for="country">País:</label>
                            <select name="domicilio_0_[country]" id="dom_country_0" onchange="alumnosView.loadStates(this.value, this.id);">
                                {country}
                                <option value="{id}">{ds_pais}</option>
                                {/country}
                            </select>
                        </div>
                        <div class="input">
                            <label for="provincia">Provincia:</label>
                            <select name="domicilio_0_[provincia]" id="dom_provincia_0" onchange="alumnosView.loadLocalidades(this.value, this.id);">
                                {provincia}
                                <option value="{id}">{ds_provincia}</option>
                                {/provincia}
                            </select>
                        </div>
                        <div class="input">
                            <label for="localidad">Localidad:</label>
                            <select id="dom_localidad_0" name="domicilio_0_[localidad]">
                                {localidad}
                                <option value="{id}">{ds_localidad}</option>
                                {/localidad}
                            </select>
                        </div>
                        <input id="cant_domicilio" type="hidden" name="cant_domicilio" value="1"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <button onclick="return alumnosView.submitForm('form', true)">Guardar</button>
            </div>
        </div>
    </form>
</div>        