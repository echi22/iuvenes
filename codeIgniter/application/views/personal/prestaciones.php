    <div >
        <table class="content-center">
            <tr class="table_header">
                <td></td><td>Nombre Cargo</td> <td>Establecimiento</td> <td>Inicio Vigencia</td> <td>Fin Vigencia</td>
                <td>Estado</td> <td>Carga Horaria</td> <td>Secuencia</td><td>Liq. Sueldo</td> <td>Sit. Revista</td>
                <td>Asig. Familiar</td><td>% Asig. Familiar</td>
            </tr>
            <?php 
                $i =0;
                foreach($personal->prestacion as $prestacion){
                    $i++;                
            ?>            
            <tr>
                <td><?php echo $prestacion->nombre; ?></td>
                <td><?php echo $prestacion->establecimiento->ds_establecimiento; ?></td>
                <td><?php echo $prestacion->dt_inicio; ?></td>
                <td><?php echo $prestacion->dt_fin; ?></td>
                <td><?php echo $prestacion->estado; ?></td>
                <td><?php echo $prestacion->carga_horaria; ?></td>
                <td><?php echo $prestacion->secuencia; ?></td>
                <td><?php echo $prestacion->tp_liq_sueldo->descripcion; ?></td>
                <td><?php echo $prestacion->wsituacion_revista->descripcion; ?></td>
                <td><?php echo $prestacion->asig_familiar; ?></td>
                <td><?php echo $prestacion->porc_asig_familiar; ?></td>
                <td>
                    <div id="icons">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="alumnosView.deleteRelated(this,<?php echo $alumno->persona->id; ?>,<?php echo $prestacion->pariente_id; ?>);"><span class="ui-icon ui-icon-minus" style="margin: 0 4px;"></span></li>
                    </div>                    
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="insert_form" class="content-center" >
        <div class="subtitle" style="margin-top: 20px">
            Nueva Prestación
        </div>
        <div class="row">
        <?php echo form_open("alumnos/add_related/".$alumno->persona->id); ?>
                <div class="input">
                    <label class="" for="persona">Familiar:</label>
                    <input type="text" id="persona" name="persona" readonly="true" />
                    <div id="icons">
                        <a href="<?php echo base_url(); ?>alumnos/add_related_view" target="_blank"><li class="ui-state-default ui-corner-all" title="Seleccionar" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>
                    </div>                                        
                    <input type="hidden" name="persona_id" id="persona_id" />
                </div>
                <div class="input">
                    <label for="parentezco">Parentezco:</label>
                    <input type="text" id="parentezco" name="parentezco" />
                </div>
                <div class="input">
                    <label for="autorizado">Autorizado:</label>
                    <input type="checkbox" id="autorizado" name="autorizado" />
                </div>
                

            
        </div>
        <div class="row">
            <button onclick="add_related.submit()">Nuevo Vínculo</button>
            </form>
            
<!--            <button  />Modificar</button>-->
        </div>
    </div>
    

