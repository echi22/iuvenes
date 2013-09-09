<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/imagePreview.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/PersonalesView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
    personalesView = new PersonalesView();
    $(document).ready(function()
    {
        $('.image').preimage();
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
    <form id="form" enctype="multipart/form-data" action="<?php echo base_url() . 'personales/create'; ?>" id="form" method="post">   
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Personal
            </div>
            <div class="subtitle border_top">
                Datos Personales
            </div>
            <div class="row">
                <div class="input">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos"  class="required" required/>
                </div>
                <div class="input">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres"  name="nombres" class="required" required/>
                </div>
                <div class="input">
                    <label for="cuil">CUIL:</label>
                    <input type="text" id="cuil"  name="cuil" class="required" required/>
                </div>
                <div class="input">
                    <label for="mail">Mail:</label>
                    <input type="email" id="mail"  name="mail" />
                </div>
                <div id="prev_image" class="foto_container"></div><br/>

            </div>
            <div  id="identificaciones">         
                <div id="identificacion" class="row">
                    <div class="input">
                        <label for="cd_identificacion">Tipo Identificación:</label>
                        <select id="cd_identificacion" name="identificacion_0_[cd_identificacion]" class="required" required>
                            {identificacion}
                            <option value="{id}">{ds_identificacion}</option>
                            {/identificacion}
                        </select>
                    </div>
                    <div class="input">
                        <label for="ds_identificacion">Número:</label>
                        <input type="text" id="ds_identificacion" name="identificacion_0_[numero_identificacion]" class="required" required/>
                    </div>     
                    <div class="input" id="icons">
                        <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_identificacion" onclick="alumnosView.addRow('identificacion', 'identificaciones');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                    </div>                    
                </div>
                <input type="hidden" id="cant_identificacion" name="cant_identificacion" value="1" />
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
            </div>
            <div class="row border_bottom">
                <div class="input">
                    <label for="image">Fecha último psicofísico:</label>
                    <input type="date" name="dt_psicofisico" id="dt_psicofisico" />
                </div>
                <div class="input">
                    <label for="image">Foto:</label>
                    <input type="file" name="image" id="image" class="image"/>
                </div>
            </div>
            <div class="subtitle">
                Teléfonos
            </div>
            <div id="telefonosContainer">
                <div class="row border_bottom" id="telefonoData"> 
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
                        <div class="input" id="icons">
                            <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_domicilio" onclick="alumnosView.addRow('domicilio', 'domicilios');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
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
                            <select name="domicilio_0_[country]" id="dom_country_0" onchange="personalesView.loadStates(this.value, this.id);">
                                {country}
                                <option value="{id}">{ds_pais}</option>
                                {/country}
                            </select>
                        </div>
                        <div class="input">
                            <label for="provincia">Provincia:</label>
                            <select name="domicilio_0_[provincia]" id="dom_provincia_0" onchange="personalesView.loadLocalidades(this.value, this.id);">
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
                    </div>
                </div>
                <input id="cant_domicilio" type="hidden" name="cant_domicilio" value="1"/>
            </div>
            <div class="subtitle">
                Estudios
            </div>
            <div  id="titulos">         
                <div id="titulo" class="row">
                    <div class="input">
                        <label for="ds_titulo">Título</label>
                        <input type="text" id="ds_titulo" class="required" required name="titulo_0_[ds_titulo]" />
                    </div>
                    <div class="input">
                        <label for="dt_titulo">Fecha:</label>
                        <input type="date" id="dt_titulo" class="required" required name="titulo_0_[fecha]"/>
                    </div>     
                    <div class="input">
                        <label for="institucion">Institución:</label>
                        <input type="text" id="institucion" class="required" required name="titulo_0_[institucion]"/>
                    </div> 
                    <div class="input">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="titulo_0_[estado]" >
                            <option value="1">Completo</option>
                            <option value="0">Incompleto</option>
                            <option value="2">En trámite</option>
                        </select>
                    </div> 
                    <div class="div_input_chico">
                        <label for="porcentaje">Porcentaje:</label>
                        <input type="text" size="10" id="porcentaje" name="titulo_0_[porcentaje]"/>
                    </div>
                    <div class="input" id="icons">
                        <li class="ui-state-default ui-corner-all" title="Agregar" id="agregar_titulo" onclick="alumnosView.addRow('titulo', 'titulos');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                    </div>                    
                </div>
                <input type="hidden" id="cant_titulo" name="cant_titulo" value="1" />             
            </div>

            <div class="row">
                <button onclick="return personalesView.submitForm('form', true)">Guardar</button>
            </div>



        </div>
    </form>
</div>        