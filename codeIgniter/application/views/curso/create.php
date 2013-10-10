<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    //first, detect when initial DD changes
 function init(){
   
}
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'cursos/create'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Curso
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="ciclo_lectivo">Ciclo Lectivo:</label>
                    <input type="text" id="ciclo_lectivo" name="id_ciclo_lectivo" class="required" required/>
                </div>
                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="anio_nivel" name="anio_nivel" class="required" required>
                        {anios_niveles}
                        <option value="{id}">{detalle}</option>
                        {/anios_niveles}
                    </select>
                </div>
                               
            </div>
            <div class="row border_bottom">
                <div class="input">
                    <label for="turno">Turno:</label>
                    <select name="cd_turno" id="turno" class="required" required>
                        <option value='m'>Mañana</option>
                        <option value='t'>Tarde</option>
                    </select>
                </div>
                <div class="input">
                    <label for="seccion">Sección:</label>
                    <input type="text" name="ds_seccion" id="seccion" class="required" required/>
                </div>                       
            </div>            
            <div style="clear: both"></div>
            
            <div class="row">
                <button onclick="cursosView.selectAllOptionsFromSelectbox('alumnos_seleccionados');return alumnosView.submitForm('form',true)">Guardar</button>
            </div>
        </div>
    </form>
</div>        