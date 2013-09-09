    <table  class="table_data tablesorter">
        <thead>
            <tr class="table_header">
                <th>Fecha</th> <th>Estado</th>
            </tr>
        </thead>
        <tbody>

            <?php      
           
           
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($alumno->alumno_vigencia as $periodo) {
                ?>
                <tr class="<?php echo $classes[($i % 2)]; ?>">
                    <td><?php echo $periodo->fecha; ?></td>
                    <td><?php echo ($periodo->estado) ? "Vigente" : "No Vigente"; ?></td>
                </tr>            
            <?php } ?>
        </tbody>
    </table>
</form>
<div style="clear: both"></div>