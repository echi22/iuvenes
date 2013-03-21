<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    //first, detect when initial DD changes
    
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'cursos/modify/'.$curso->id; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">            
            <div class="row">
                <div class="input">
                    <label for="ciclo_lectivo">Ciclo Lectivo:</label>
                    <input type="text" id="ciclo_lectivo" name="id_ciclo_lectivo" value="<?php echo $curso->id_ciclo_lectivo; ?>" class="required"/>
                </div>
                <div class="input">
                    <label for="year">Año:</label>
                    <input type="text" id="year" name="year" value="<?php echo $curso->anio_nivel->ds_anio; ?>" class="required"/>
                </div>

                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="nivel" name="nivel" class="required">
                        {nivel_educativo}
                        <option value="{id}">{ds_nivel}</option>
                        {/nivel_educativo}
                    </select>
                    <script type="text/javascript">
                        cursosView.setSelectedIndexByValue('<?php echo $curso->anio_nivel->nivel_educativo->id; ?>','nivel');           
                    </script>
                </div>

                <div class="input">
                    <label for="orientacion">Orientacion:</label>
                    <select id="orientacion" name="orientacion" class="required">
                        {orientacion}
                        <option value="{id}">{ds_orientacion}</option>
                        {/orientacion}
                    </select>
                    <script type="text/javascript">
                        cursosView.setSelectedIndexByValue('<?php echo $curso->anio_nivel->orientation->id; ?>','orientacion');           
                    </script>
                </div>                      
            </div>
            <div class="row border_bottom">
                <div class="input">
                    <label for="turno">Turno:</label>
                    <select name="cd_turno" id="turno" class="required">
                        <option value='m'>Mañana</option>
                        <option value='t'>Tarde</option>
                    </select>
                    <script type="text/javascript">
                        cursosView.setSelectedIndexByValue('<?php echo $curso->cd_turno; ?>','turno');           
                    </script>
                </div>
                <div class="input">
                    <label for="seccion">Sección:</label>
                    <input type="text" name="ds_seccion" id="seccion" value="<?php echo $curso->ds_seccion; ?>" class="required"/>
                </div>                       
            </div>            
            <div style="clear: both"></div>
            <div class="row">
                <button onclick="return alumnosView.submitForm('form',true)">Modificar</button>
            </div>
        </div>
    </form>
</div>        