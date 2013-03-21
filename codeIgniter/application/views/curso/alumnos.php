<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    //first, detect when initial DD changes
     $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    }); 
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
                url : '../get_cursos_by_year',
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
            cursosView.actualizarAlumnos($("#años_cursos").val(),$("#cursos"),$('#alumnos'),<?php echo $curso->id; ?>);
        });
        cursosView.actualizarAlumnos($("#años_cursos").val(),$("#cursos"),$('#alumnos'),<?php echo $curso->id; ?>);
    }
</script>
<form name="form1"  action="<?php echo base_url() . 'cursos/save_alumnos/' . $curso->id; ?>" id="form1" method="post">    

    <div >
        <div class="subtitle">
            Cursos:
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

                <select id="cursos" onchange="cursosView.actualizarAlumnos($('#años_cursos').val(),$('#cursos'),$('#alumnos'),<?php echo $curso->id; ?>)">

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
                <div style="clear: both"></div>
                <label for="filtro_alumno" style="display: inline">Nombre o DNI:</label><input id="filtro_alumno" type="text" onkeyup="cursosView.actualizarAlumnos($('#años_cursos').val(),$('#cursos'),$('#alumnos'),<?php echo $curso->id; ?>)" onchange="cursosView.actualizarAlumnos($('#cursos'),$('#alumnos'))">

            </div>
            <div class="columna_ajustada valign-middle">
                <input type="button" onclick="cursosView.selectMoveRows(document.getElementById('alumnos'),document.getElementById('alumnos_seleccionados'),cursosView.alumnosSelected,cursosView.listadoAlumnos)" value="Agregar >>" style="display: block;"/>
                <input type="button" onclick="cursosView.selectMoveRows(document.getElementById('alumnos_seleccionados'),document.getElementById('alumnos'),cursosView.alumnosSelected,cursosView.listadoAlumnos)" value="<< Quitar" style="display: block;"/>
            </div>
        </div>
        <div class="columna_ajustada">

            <select multiple="true" name="alumnos_seleccionados[]" id="alumnos_seleccionados" class="multiple_select_box select_box_alumnos">

            </select>
        </div>
    </div>      
    <div style="clear: both"></div>
    <div class="row">
        <button onclick="cursosView.selectAllOptionsFromSelectbox('alumnos_seleccionados');return alumnosView.submitForm('form1',true)">Guardar</button>
    </div>
</form>
<table class="content-center tablesorter" id="myTable">
    <thead>
        <tr class="table_header">
            <th>Apellidos</th><th>Nombres</th><th>Identificación</th><th>Fecha de Nacimiento</th><th>Nacionalidad</th><th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $class = Array("odd", "even");
        foreach ($curso->alumnos as $i => $a) {
            ?>
            <tr class="<?php echo $class[($i % 2)]; ?> alumno">
                <td><?php echo $a->persona->apellidos; ?></td>
                <td><?php echo $a->persona->nombres; ?></td>
                <td>
                    <?php
                    foreach ($a->persona->persona_identificacion as $identificacion) {
                        if ($identificacion->principal) {
                            ?>                   
                            <?php echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion; ?></br>
                            <?php
                        }
                    }
                    ?>
                </td>
                <td><?php echo $a->persona->dt_nac; ?></td>
                <td><?php echo $a->persona->country->ds_pais; ?></td>
                <td> <div id="icons">
                        <a href="<?php echo base_url() . 'alumnos/alumno_data/' . $a->persona->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                    </div> 
                    <div id="icons" style="float: left">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="cursosView.deleteAlumno(this,<?php echo $a->id; ?>,<?php echo $curso->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                    </div> 
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<div style="clear: both"></div>
<?php include('application/views/templates/pager.php'); ?>