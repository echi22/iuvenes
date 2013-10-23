<table  class="table_data tablesorter" style="width: 300px;">
        <thead>
            <tr class="table_header">
                <th>Fecha</th> <th>Estado</th>
            </tr>
        </thead>
        <tbody>

            <?php      
           
           
            $classes = Array("odd", "even");
            $i = 0;
            foreach ($personal->personal_vigencia as $periodo) {
                ?>
                <tr class="<?php echo $classes[($i % 2)]; ?>">
                    <td><?php echo date_format(date_create($periodo->fecha), 'd-m-Y');   ?></td>
                    <td><?php echo ($periodo->estado) ? "Vigente" : "No Vigente"; ?></td>
                </tr>            
            <?php } ?>
        </tbody>
    </table>
</form>
<div style="clear: both"></div>
