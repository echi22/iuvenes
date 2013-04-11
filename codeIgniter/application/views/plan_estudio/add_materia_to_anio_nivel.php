<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_materia_to_anio_nivel'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Materia
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="year">Materia nueva:</label>
                    <input type="text" id="nueva_materia" name="nueva_materia" onchange="alumnosView.setSelectedIndexByValue('', 'materia_selected')" />
                </div>

                <div class="input">
                    <label for="nivel">Materia existente:</label>
                    <select id="materia_selected" name="materia_selected" onchange="alumnosView.setSelectedIndexByValue('', 'nueva_materia')">
                        <option value="">- Seleccionar - </option>
                        {materias}
                        <option value="{id}">{nombre}</option>
                        {/materias}
                    </select>
                </div>
                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="anio_nivel" name="anio_nivel" class="required">
                        {anios_niveles}
                        <option value="{id}">{detalle}</option>
                        {/anios_niveles}
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