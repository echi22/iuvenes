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
    cursosView.actualizarAlumnos($("#cursos"),$('#alumnos'));
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
                    <label for="nivel">Nivel:</label>
                    <select id="anio_nivel" name="anio_nivel" class="required">
                        {anios_niveles}
                        <option value="{id}">{detalle}</option>
                        {/anios_niveles}
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
            <div style="clear: both"></div>
            
            <div class="row">
                <button onclick="cursosView.selectAllOptionsFromSelectbox('alumnos_seleccionados');return alumnosView.submitForm('form',true)">Guardar</button>
            </div>
        </div>
    </form>
</div>        