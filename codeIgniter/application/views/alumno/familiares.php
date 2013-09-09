<script type="text/javascript">
    $(document).ready(function()
    {
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")});
    }
    );
</script>
<div >
    <table class="content-center tablesorter" id="myTable">
        <thead>
            <tr class="table_header">
                <th>Apellido</th> <th>Nombre</th> <th>parentesco</th> <th>Identificación</th>
                <th>Teléfonos</th> <th>Autorizado</th> <th>Observaciones</th><th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $class = Array('odd', 'even');
            $i = 0;

            foreach ($alumno->persona->persona_es as $vinculo) {
                $i++;
                include("familiares_row.php");
            }
            foreach ($alumno->persona->persona_de as $vinculo) {
                $i++;
                include("familiares_row.php");
            }
            ?>
        </tbody>
    </table>
</div>
<div style="clear: both"></div>
<?php include('application/views/templates/pager.php'); ?>
<div id="insert_form" class="content-center" >
    <div class="subtitle" style="margin-top: 20px">
        Nuevo Vinculo
    </div>
    <div class="row">
<?php echo form_open("alumnos/add_related/" . $alumno->persona->id); ?>
        <div class="input_grande">
            <label class="" for="persona">Familiar:</label>
            <input type="text" id="persona" name="persona" readonly="true" style="float: left"/>
            <div id="icons" style="float: left">
                <a href="<?php echo base_url(); ?>alumnos/add_related_view" target="_blank"><li class="ui-state-default ui-corner-all" title="Seleccionar" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
            </div>                                        
            <input type="hidden" name="persona_id" id="persona_id" />
        </div>
        <div class="input">
            <label for="parentesco">parentesco:</label>
            <input type="text" id="parentesco" name="parentesco" />
        </div>
        <div class="input">
            <label for="autorizado">Autorizado:</label>
            <input type="checkbox" id="autorizado" name="autorizado" />
        </div>



    </div>
    <div class="row">
        <button onclick="add_related.submit()">Guardar Vínculo</button>
        </form>

        <!--            <button  />Modificar</button>-->
    </div>
</div>


