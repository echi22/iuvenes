<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_anio_nivel'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Año Nivel
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="year">Año:</label>
                    <input type="text" id="year" name="year" class="required"/>
                </div>

                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="nivel" name="nivel" class="required">
                        {nivel_educativo}
                        <option value="{id}">{ds_nivel}</option>
                        {/nivel_educativo}
                    </select>
                </div>
                <div class="input">
                    <label for="orientacion">Orientacion:</label>
                    <select id="orientacion" name="orientacion" class="required">
                        {orientacion}
                        <option value="{id}">{ds_orientacion}</option>
                        {/orientacion}
                    </select>
                </div>                 
            </div>            
            <div style="clear: both"></div>

            <div class="row">
                <button onclick="return alumnosView.submitForm('form',true)">Guardar</button>
            </div>
        </div>
    </form>
</div>        