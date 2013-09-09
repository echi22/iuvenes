<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/PersonalesView.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#tabs" ).tabs();});
    personalesView = new PersonalesView();
    
</script>
<div class="titulo">
    Personal - <?php echo $personal->persona->apellidos . " " . $personal->persona->nombres; ?>
</div>

<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#tabs-1">Nueva Prestación</a></li>
    </ul>
    <div id="tabs-1">
        <?php echo form_open_multipart('personales/add_prestacion/' . $persona_id); ?>
        <div id="insert_form" >        
            <div class="row">
                <div class="input">
                    <input type="hidden"  name="persona_id" value="<?php echo $persona_id; ?>" />
                    <label for="nombre_cargo">Nombre Cargo</label>
                    <select name="cargo" id="cargo">
                        <?php foreach ($cargo as $c) { ?>
                            <option value="<?php echo $c->id; ?>">
                                <?php echo $c->ds_cargo; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input">
                    <label for="dt_inicio">Fecha Inicio</label>
                    <input type="date" name="dt_inicio" id="dt_inicio" />
                </div>
                <div class="input">
                    <label for="dt_fin">Fecha fin</label>
                    <input type="date" name="dt_fin" id="dt_fin" />
                </div>
                <div class="input">
                    <label for="carga_horaria">Carga Horaria:</label>
                    <input type="text" id="carga_horaria" name="qt_horas" class="required" required/>
                </div>      
                <div class="input">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado">
                        <option value="S">Vigente</option>
                        <option value="N">No Vigente</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input">
                    <label for="nu_secuencia">N° Secuencia:</label>
                    <input type="text" name="nu_secuencia" id="nu_secuencia" class="required" required/>
                </div>
                <div class="input">
                    <label for="tp_liq_sueldo">Liquidación Sueldo:</label>
                    <select name="tp_liq_sueldo" id="tp_liq_sueldo">
                        <?php foreach ($liquidacion_sueldo as $tp) { ?>
                            <option value="<?php echo $tp->id; ?>">
                                <?php echo $tp->detalle; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input">
                    <label for="revista">Sit. Revista:</label>
                    <select name="revista" id="revista">
                        <?php foreach ($wsituacion_revista as $rev) { ?>
                            <option value="<?php echo $rev->id; ?>">
                                <?php echo $rev->ds_sit_revista; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input">
                    <label for="asig_familiar">Asignación Familiar:<input type="checkbox" id="asig_familiar" name="asig_familiar" /></label>                

                </div>   
                <div class="input">
                    <label for="porc_asig_familiar">Porc. Asig. Familiar:</label>                
                    <input type="text" id="porc_asig_familiar" name="porc_asig_familiar" />
                </div> 

            </div>   
            <div class="row">
                <button onclick="personalesView.submitForm()">Guardar</button>
                <button onclick=" return personalesView.goBack(); " >Volver</button>
            </div>
        </div>
        </form>
    </div>
</div>


