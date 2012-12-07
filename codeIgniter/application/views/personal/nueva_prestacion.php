<?php 
      echo validation_errors(); 
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
alumnosView = new AlumnosView();
</script>

    <?php echo form_open_multipart('personales/add_prestacion');  ?>
    <div id="insert_form" class="content-center">
        <div class="titulo">
            Nueva Prestación
        </div>
        <div class="row">
            <div class="input">
                <label for="nombre_cargo">Nombre Cargo</label>
                <select name="cargo" id="cargo">
                    <?php foreach ($cargo as $c){ ?>
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
                <input type="text" id="carga_horaria" name="carga_horaria" class="required"/>
            </div>      
            <div class="input">
                <label for="activo">Estado</label>
                <select id="vive" name="vive">
                    <option value="S">Vigente</option>
                    <option value="N">No Vigente</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input">
                <label for="secuencia">N° Secuencia:</label>
                <input type="text" name="secuencia" id="secuencia" class="required"/>
            </div>
            <div class="input">
                <label for="tp_liq_sueldo">Liquidación Sueldo:</label>
                <select name="tp_liq_sueldo" id="tp_liq_sueldo">
                    <?php foreach ($liquidacion_sueldo as $tp){ ?>
                    <option value="<?php echo $tp->id; ?>">
                        <?php echo $tp->detalle; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="input">
                <label for="revista">Sit. Revista:</label>
                <select name="revista" id="revista">
                    <?php foreach ($wsituacion_revista as $rev){ ?>
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
                <button onclick="alumnosView.submitForm()">Guardar</button>
            </div>
    </div>
    </form>
       


