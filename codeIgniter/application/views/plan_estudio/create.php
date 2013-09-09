<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'plan_estudios/create'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Ley de Educación
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="ciclo_lectivo">N° de ley:</label>
                    <input type="text" id="ds_ley" name="ds_ley" class="required" required/>
                </div>
                <div class="input">
                    <label for="year">Fecha de Inicio Vigencia:</label>
                    <input type="date" id="dt_inicio_vig" name="dt_ini_vig" class="required" required/>
                </div>

                <div class="input">
                    <label for="year">Fecha de Fin Vigencia:</label>
                    <input type="date" id="dt_fin_vig" name="dt_fin_vig"/>
                </div>
                   
            </div>            
            <div style="clear: both"></div>
            
            <div class="row">
                <button onclick="if(alumnosView.submitForm('form',true)){alert('Ley de educación agregada con éxito'); return true}else{return false;}">Guardar</button>
            </div>
        </div>
    </form>
</div>        