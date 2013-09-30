<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
<div id="contenido">
    <div id="insert_form" class="content-center">
        <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_nivel_educativo'; ?>" id="form" method="post">    

            <div class="titulo">
                Alta de Nivel Educativo
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="ciclo_lectivo">Nivel educativo</label>
                    <input type="text" id="ds_nivel" name="ds_nivel" class="required" required/>
                </div>
                <div class="input">
                    <label for="year">Fecha de Inicio Vigencia:</label>
                    <input type="date" id="dt_inicio_vig" name="dt_ini_vig" class="required" required/>
                </div>

                <div class="input">
                    <label for="year">Fecha de Fin Vigencia:</label>
                    <input type="date" id="dt_fin_vig" name="dt_fin_vig"/>
                </div>
                <div class="input">
                    <label for="orientacion">Ley de educación:</label>
                    <select id="ley_educacion" name="ley_educacion" class="required" required>
                        {ley}
                        <option value="{id}">{ds_ley}</option>
                        {/ley}
                    </select>
                </div>
            </div>            
            <div style="clear: both"></div>
        </form>


        <div class="row">
            <button onclick="if(view.submitForm('form',true)){alert('Nivel agregado con éxito');return true;}else{return false;}">Guardar</button>
            <button onclick="window.location.href = 'show_nivel_educativo'">Volver</button>

        </div>
    </div>
</div>        