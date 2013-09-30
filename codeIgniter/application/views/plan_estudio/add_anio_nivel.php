<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
<div id="contenido">

    <div id="insert_form" class="content-center">
        <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_anio_nivel'; ?>" id="form" method="post">    
            <div class="titulo">
                Alta de Año Nivel
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="year">Año:</label>
                    <input type="text" id="year" name="year" class="required" required/>
                </div>

                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="nivel" name="nivel" class="required" required>                        
                        {nivel_educativo}
                        <option value="{id}">{ds_nivel}</option>
                        {/nivel_educativo}
                    </select>
                </div>
                <div class="input">
                    <label for="orientacion">Orientacion:</label>
                    <select id="orientacion" name="orientacion" class="required" required>
                        <option value="">Ninguna</option>
                        {orientacion}
                        <option value="{id}">{ds_orientacion}</option>
                        {/orientacion}
                    </select>
                </div>                 
            </div>            
            <div style="clear: both"></div>


        </form>
        <div class="row">
            <button onclick="if(view.submitForm('form',true)){alert('Año nivel agregado con éxito');return true;}else{return false;}">Guardar</button>
            <button onclick="window.location.href = 'show_anio_nivel'">Volver</button>

        </div>
    </div>
</div>        