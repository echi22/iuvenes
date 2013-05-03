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
            $docentesList = "<option value = '-'>Seleccionar</option>";
            foreach ($curso->prestacions as $prestacion) {
                $docentesList = $docentesList . "<option value = '" . $prestacion->id . "'>" . $prestacion->personal->persona->apellidos . " " . $prestacion->personal->persona->nombres . "</option>";
            }
            $materias_docentes = Array();
            foreach ($curso->materium_curso_prestacion_personals as $item) {
                $materias_docentes[$item->materium->id] = $item->prestacion->id;
            }
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($curso->anio_nivel->materiums->get() as $materia) {
                ?>
                <tr class="<?php echo $classes[($i % 2)]; ?>">
                    <td><div  id=" <?php echo $materia->nombre; ?>"   ><?php echo $materia->nombre; ?><input class="materias" type="hidden" name="materia[]" value="<?php echo $materia->id; ?>" /></div></td>
                    <td><select name="docente[]" id="<?php echo $materia->nombre . "_" . $materia->id; ?>" class="docentes">
                            <?php echo $docentesList; ?>
                        </select>
                        <script type="text/javascript">
                            cursosView.setSelectedIndexByValue('<?php echo $materias_docentes[$materia->id]; ?>','<?php echo $materia->nombre . "_" . $materia->id; ?>');           
                            cursosView.materias['<?php echo $materia->nombre; ?>'] = $("#<?php echo $materia->nombre . "_" . $materia->id; ?> option[value='<?php echo $materias_docentes[$materia->id]; ?>']").text();
                            $(".<?php echo $materia->nombre; ?>").attr('title',cursosView.materias['<?php echo $materia->nombre; ?>']);

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
    <button onclick="return cursosView.submitMaterias(<?php echo $curso->id; ?>)">Guardar</button>
</div>