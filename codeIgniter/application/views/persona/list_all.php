<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
    
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } ); 

</script>
<div>
    <table class="tablesorter" id="myTable">
        <thead>
            <tr class="table_header">
                <td>Nombre</td><td>Apellido</td><td>Identificación</td><td>Fecha de Nacimiento</td><td>Sexo</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $this->load->helper('url');
            $i = 0;
            foreach ($personas as $p) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $p->nombres; ?></td>
                    <td><?php echo $p->apellidos; ?></td>
                    <td><?php
            foreach ($p->persona_identificacion as $identificacion) {
                if ($identificacion->principal) {
                    echo $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion;
                }
            }
                ?>                    
                    </td>
                    <td><?php echo $p->dt_nac; ?></td>
                    <td><?php echo $p->sexo->ds_sexo; ?></td>
                    <td>
                        <input type="hidden" id="persona_id<?php echo $i; ?>" value="<?php echo $p->id; ?>" />
                        <input type="hidden" name="persona<?php echo $i; ?>" value="<?php echo $p->nombres . ' ' . $p->apellidos; ?>" />
                        <a onclick="alumnosView.addRelative(<?php echo $i; ?>)">+</>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div style="clear: both"></div>
    <?php include('application/views/templates/pager.php'); ?>
</div>