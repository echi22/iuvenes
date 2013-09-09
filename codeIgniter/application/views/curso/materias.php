<script type="text/javascript">
    $("#materias").tablesorter().tablesorterPager({container: $("#pager_materias")}); 
</script>
<form id="materia_docente" action="<?php echo base_url() . 'cursos/save_materia_docente/' . $curso->id; ?>" method="post">
    <table id="materias" class="table_data tablesorter">
        <thead>
            <tr class="table_header">
                <th>Materia</th> <th>Docente</th> <th>Suplente de</th> 
            </tr>
        </thead>
        <tbody>

            <?php
            $docentesList = "<option value = '-'>Seleccionar</option>";
            $docentesById = Array();
            foreach ($curso->prestacions as $prestacion) {
                $docentesList = $docentesList . "<option value = '" . $prestacion->id . "'>" . $prestacion->personal->persona->apellidos . " " . $prestacion->personal->persona->nombres . "</option>";
                $docentesById[$prestacion->id] = $prestacion;
                
            }
            $materias_docentes = Array();
            $materias_suplentes_de = Array();
            foreach ($curso->materium_curso_prestacion_personals as $item) {
                $materias_docentes[$item->materium->id] = $item->prestacion->id;
            }
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($curso->anio_nivel->materiums->get() as $materia) {
                ?>
                <tr class="<?php echo $classes[($i % 2)]; ?>">
                    <td><div  id=" <?php echo str_replace(' ','',$materia->nombre); ?>"   ><?php echo $materia->nombre; ?><input class="materias" type="hidden" name="materia[]" value="<?php echo $materia->id; ?>" /></div></td>
                    <td><select name="docente[]" id="<?php echo str_replace(' ','',$materia->nombre) . "_" . $materia->id; ?>" class="docentes">
                            <?php echo $docentesList; ?>
                        </select>
                        <script type="text/javascript">
                            cursosView.setSelectedIndexByValue('<?php echo $materias_docentes[$materia->id]; ?>','<?php echo str_replace(' ','',$materia->nombre) . "_" . $materia->id; ?>');           
                            cursosView.materias['<?php echo str_replace(' ','',$materia->nombre); ?>'] = $("#<?php echo str_replace(' ','',$materia->nombre) . "_" . $materia->id; ?> option[value='<?php echo $materias_docentes[$materia->id]; ?>']").text();
                            $(".<?php echo str_replace(' ','',$materia->nombre); ?>").attr('title',cursosView.materias['<?php echo str_replace(' ','',$materia->nombre); ?>']);

                        </script>
                    </td>
                    <td>
                        <?php 
                            $showSuplentes = (isset($docentesById[$materias_docentes[$materia->id]]) && ($docentesById[$materias_docentes[$materia->id]]->isSuplente()));                           
                        ?>
                        <select name="suplentes[]" <?php if(!$showSuplentes) echo 'hidden';  ?> id="<?php echo str_replace(' ','',$materia->nombre)."_". $materia->id."_suplente"; ?>" class="suplentes" >
                            <?php echo $docentesList; ?>
                        </select>
                        <?php 
                            if($showSuplentes){
                        ?>
                        <script type="text/javascript">
                            cursosView.setSelectedIndexByValue('<?php echo $materias_suplentes_de[$materia->id]; ?>','<?php echo $materia->nombre . "_" . $materia->id ."_suplente"; ?>');           
                            cursosView.materias['<?php echo $materia->nombre; ?>'] = $("#<?php echo $materia->nombre . "_" . $materia->id; ?> option[value='<?php echo $materias_docentes[$materia->id]; ?>']").text();
                            $(".<?php echo $materia->nombre; ?>").attr('title',cursosView.materias['<?php echo $materia->nombre; ?>']);

                        </script>
                        <?php 
                            }
                            
                        ?>
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