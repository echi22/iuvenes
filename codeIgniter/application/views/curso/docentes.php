<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    //first, detect when initial DD changes
     $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    }); 
    function init(){
//        $("#años_cursos").change(function() {
//            //get what they selected
//            var selected = $("option:selected",this).val();
//        
//            //no matter what, clear the other DD
//            //Tip taken from: http://stackoverflow.com/questions/47824/using-core-jquery-how-do-you-remove-all-the-options-of-a-select-box-then-add-on
//            $("#cursos").children().remove().end().append("<option value=\"\">Todos</option>");
//            //now load in new options if I picked a state
//            if(selected == "") return;                
//            $.ajax({
//                url : '../get_cursos_by_year',
//                type: "POST",
//                data : {"id_ciclo_lectivo":selected},
//                success : function(res) {
//                    res = jQuery.parseJSON(res);
//                    var newoptions = "";
//                    for(var i=0; i<res.length; i++) {
//                        //In our result, ID is what we will use for the value, and NAME for the label
//                        newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['name'] + "</option>";
//                    }
//                    $("#cursos").children().end().append(newoptions);
//                }           
//            });
//            cursosView.actualizarAlumnos($("#cursos"),$('#alumnos'));
//        });
        cursosView.actualizarPrestaciones($("#prestaciones"));
    }
</script>
<form name="form2"  action="<?php echo base_url() . 'cursos/save_prestaciones/' . $curso->id; ?>" id="form2" method="post">    

    <div >
        <div class="subtitle">
            Prestaciones:
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

                <select multiple="true" id="prestaciones" name="prestaciones" class="multiple_select_box select_box_alumnos">
                    <?php
                    foreach ($prestaciones as $prestacion) {
                        $identificacion = $prestacion->personal->get_identificacion_principal();
                        ?>

                        <option value="<?php echo $prestacion->id; ?>">
                            <?php echo $prestacion->cargo->ds_cargo. " ". $prestacion->personal->persona->apellidos . " " . $prestacion->personal->persona->nombres . " - " . $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion; ?>
                        </option>
                    <?php } ?>   
                </select>
                <div style="clear: both"></div>
                <label for="filtro_alumno" style="display: inline">Nombre o DNI:</label><input id="filtro_prestacion" type="text" onkeyup="cursosView.actualizarPrestaciones($('#prestaciones'))" onchange="cursosView.actualizarPrestaciones($('#prestaciones'))">

            </div>
            <div class="columna_ajustada valign-middle">
                <input type="button" onclick="cursosView.selectMoveRows(document.getElementById('prestaciones'),document.getElementById('prestaciones_seleccionadas'),cursosView.prestacionesSelected,cursosView.listadoPrestaciones)" value="Agregar >>" style="display: block;"/>
                <input type="button" onclick="cursosView.selectMoveRows(document.getElementById('prestaciones_seleccionadas'),document.getElementById('prestaciones'),cursosView.prestacionesSelected,cursosView.listadoPrestaciones)" value="<< Quitar" style="display: block;"/>
            </div>
        </div>
        <div class="columna_ajustada">

            <select multiple="true" name="prestaciones_seleccionadas[]" id="prestaciones_seleccionadas" class="multiple_select_box select_box_alumnos">

            </select>
        </div>
    </div>      
    <div style="clear: both"></div>
    <div class="row">
        <button onclick="cursosView.selectAllOptionsFromSelectbox('prestaciones_seleccionadas');return alumnosView.submitForm('form2',true)">Guardar</button>
    </div>
</form>
