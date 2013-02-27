<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    //first, detect when initial DD changes
 function init(){
    $("#años_cursos").change(function() {
        //get what they selected
        var selected = $("option:selected",this).val();
        
        //no matter what, clear the other DD
        //Tip taken from: http://stackoverflow.com/questions/47824/using-core-jquery-how-do-you-remove-all-the-options-of-a-select-box-then-add-on
        $("#cursos").children().remove().end().append("<option value=\"\">Todos</option>");
        //now load in new options if I picked a state
        if(selected == "") return;                
        $.ajax({
                url : 'get_cursos_by_year',
                type: "POST",
                data : {"id_ciclo_lectivo":selected},
                success : function(res) {
                            res = jQuery.parseJSON(res);
                            var newoptions = "";
                            for(var i=0; i<res.length; i++) {
                                //In our result, ID is what we will use for the value, and NAME for the label
                                newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['name'] + "</option>";
                            }
                            $("#cursos").children().end().append(newoptions);
                        }           
            });
    });
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
                    <input type="text" id="ciclo_lectivo" name="id_ciclo_lectivo" class="required"/>
                </div>
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
            <div class="row border_bottom">
                <div class="input">
                    <label for="turno">Turno:</label>
                    <select name="cd_turno" id="turno" class="required">
                        <option value='m'>Mañana</option>
                        <option value='t'>Tarde</option>
                    </select>
                </div>
                <div class="input">
                    <label for="seccion">Sección:</label>
                    <input type="text" name="ds_seccion" id="seccion" class="required"/>
                </div>                       
            </div>
            <div >
                <div class="subtitle">
                    Alumnos:
                </div>
                <div class="row">
                    <div class="columna_ajustada">
                        
                        <select id="años_cursos">
                            {años_cursos}
                                <option value="{id_ciclo_lectivo}">{id_ciclo_lectivo}</option>
                            {/años_cursos}
                        </select>
                        
                    </div>
                    <div class="columna_ajustada">

                        <select id="cursos" onchange="cursosView.actualizarAlumnos(this,$('#alumnos'))">

                        </select>
                    </div>
                </div>
            </div>
            <div >
                <div class="columna_ajustada">
                    <div class="columna_ajustada">
                        <select multiple="true" id="alumnos" name="alumnos" class="multiple_select_box select_box_alumnos">
                            <?php
                            foreach ($alumnos as $alumno) {
                                $identificacion = $alumno->get_identificacion_principal();
                                ?>

                                <option value="<?php echo $alumno->id; ?>">
                                <?php echo $alumno->persona->apellidos . " " . $alumno->persona->nombres . " - " . $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion; ?>
                                </option>
<?php } ?>   
                        </select>
                    </div>
                    <div class="columna_ajustada valign-middle">
                        <input type="button" onclick="cursosView.selectMoveRows(document.form.alumnos,document.form.alumnos_seleccionados)" value="Agregar >>" style="display: block;"/>
                        <input type="button" onclick="cursosView.selectMoveRows(document.form.alumnos_seleccionados,document.form.alumnos)" value="<< Quitar" style="display: block;"/>
                    </div>
                </div>
                <div class="columna_ajustada">

                    <select multiple="true" name="alumnos_seleccionados" id="alumnos_seleccionados" class="multiple_select_box select_box_alumnos">

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