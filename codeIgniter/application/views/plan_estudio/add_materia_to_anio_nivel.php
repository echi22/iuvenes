<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/PlanEstudioView.js"></script>
<script type="text/javascript">
    planEstudioView = new PlanEstudioView();
    $(function() {
    $( "#niveles #materias" ).sortable();
    $( "#niveles #materias" ).disableSelection();
  });
</script>
<div id="contenido">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Materia
            </div>
            <div class="subtitulo">
                Seleccione los niveles y las materias a agregar
            </div> 
            <div class="row border_top">
                <div class="input">
                    <label for="nivel">Nivel:</label>
                    <select id="anio_nivel" name="anio_nivel" class="required" required>
                        {anios_niveles}
                        <option value="{id}">{detalle}</option>
                        {/anios_niveles}
                    </select>                   
                </div>      
                <div class="input" id="icons" style="padding-top: 10px">
                    <li class="ui-state-default ui-corner-all" title="Agregar"  onclick="planEstudioView.addNivel('anio_nivel','niveles');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                </div>
                <div class="input">
                    <label for="materia_selected">Materia:</label>
                    <select id="materia_selected" name="materia_selected" >
                        {materias}
                        <option value="{id}">{nombre}</option>
                        {/materias}
                    </select>                    
                </div>       
                <div class="input" id="icons" style="padding-top: 10px">
                    <li class="ui-state-default ui-corner-all" title="Agregar" onclick="planEstudioView.addMateria('materia_selected','materias');"><span class="ui-icon ui-icon-plus" style="margin: 0 4px;"></span></li>
                </div>
            </div>            
            <div style="clear: both"></div>
            <table class="table_data tablesorter" style="width: 50%">
                <thead>
                    <tr class="table_header">
                        <th>Niveles</th> <th>Materias</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <ul id="niveles" class="lista" style="list-style: none;"></ul>
                        </td>
                        <td style="width: 50%;">
                            <ul id="materias" class="lista" style="list-style: none;"></ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <button onclick="planEstudioView.addMateriasToAnioNivel();return false;">Guardar</button>
            </div>
        </div>
</div>        