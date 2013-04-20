<script type="text/javascript">
    $("#materias").tablesorter().tablesorterPager({container: $("#pager_materias")}); 
</script>
<form id="materia_docente" action="<?php echo base_url() . 'cursos/save_materia_docente/' . $curso->id; ?>" method="post">
    <table id="materias" class="table_data tablesorter">
        <thead>
            <tr class="table_header">
                <th>Materia</th> <th>Docente</th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach ($curso->prestacions as $prestacion) {
            $docentesList = $docentesList . "<option value = '" . $prestacion->id . "'>" . $prestacion->personal->persona->apellidos . " " . $prestacion->personal->persona->nombres . "</option>";
        }
        $classes = Array("odd", "even");
        $i = 0;
        foreach ($curso->anio_nivel->materiums->get() as $materia) {
            ?>
            <tr class="<?php echo $classes[($i % 2)]; ?>">
                <td><div  id=" <?php echo $materia->nombre; ?>"   ><?php echo $materia->nombre; ?><input type="hidden" name="materia[]" value="<?php echo $materia->nombre; ?>" /></div></td>
                <td><select name="docente[]" id="<?php echo $materia->nombre . "_" . $materia->id; ?>">
                        <?php echo $docentesList; ?>
                    </select>
                    <script type="text/javascript">
                        cursosView.setSelectedIndexByValue('<?php echo $identificacion->widentificacion->id; ?>','<?php echo $materia->nombre . "_" . $materia->id; ?>');           
                    </script>
                </td>
            </tr>            
        <?php } ?>
        </tbody>
    </table>
</form>
<div style="clear: both"></div>
<div>
            <?php
            $pagerName = "pager_materias";
            include('application/views/templates/pager.php');
            ?>
</div>

<div class="row">
    <button onclick="return cursosView.submitForm('materia_docente',true)">Guardar</button>
</div>