    <div >
        <table class="table_data">
            <tr class="table_header">
                <td>Nombre Cargo</td> <td>Establecimiento</td> <td>Inicio Vigencia</td> <td>Fin Vigencia</td>
                <td>Estado</td> <td>Carga Horaria</td> <td>Secuencia</td><td>Liq. Sueldo</td> <td>Sit. Revista</td>
                <td>Asig. Familiar</td><td>% Asig. Familiar</td>
            </tr>
            <?php 
                $i =0;
                foreach($personal->prestacion as $prestacion){
                    $i++;                
            ?>            
            <tr>
                <td><?php echo $prestacion->cargo->ds_cargo; ?></td>
                <td>-<?php // echo $prestacion->establecimiento->ds_establecimiento; ?></td>
                <td><?php echo $prestacion->dt_inicio; ?></td>
                <td><?php echo $prestacion->dt_fin; ?></td>
                <td><?php echo ($prestacion->estado == 'S') ? 'Vigente' : 'No vigente'; ?></td>
                <td><?php echo $prestacion->qt_horas; ?></td>
                <td><?php echo $prestacion->nu_secuencia; ?></td>
                <td><?php echo $prestacion->tipo_liquidacion_sueldo->detalle; ?></td>
                <td><?php echo $prestacion->wsituacion_revista->ds_sit_revista; ?></td>
                <td><?php echo ($prestacion->asig_familiar) ? 'Sí' : 'No'; ?></td>
                <td><?php echo $prestacion->porc_asig_familiar; ?></td>
                <td>
                    <div id="icons">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="alumnosView.deleteRelated(this,<?php echo $personal->persona->id; ?>,<?php echo $prestacion->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                    </div>                    
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
            
    <a href="<?php echo base_url(); ?>/personales/add_prestacion/<?php echo $personal->persona->id; ?>">
        <button>Nueva Prestación</button>
    </div>


