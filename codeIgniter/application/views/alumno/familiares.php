    <div >
        <table class="content-center">
            <tr class="table_header">
                <td></td><td>Apellido</td> <td>Nombre</td> <td>Parentezco</td> <td>Identificación</td>
                <td>Teléfonos</td> <td>Autorizado</td> <td>Observaciones</td><td></td>
            </tr>
            <?php 
                $class="table_row2";
                $i =0;
                foreach($alumno->persona->persona_es as $vinculo){
                    $i++;
                if($class == "table_row1")
                            $class = "table_row2";
                        else
                            $class = "table_row1";
            ?>            
            <tr class="<?php echo $class; ?> familiar">
                <td><?php echo $i; ?></td>
                <td><?php echo $vinculo->pariente->apellidos; ?></td>
                <td><?php echo $vinculo->pariente->nombres; ?></td>
                <td><?php echo $vinculo->parentezco; ?></td>
                <td><?php foreach ($vinculo->pariente->persona_identificacion as $identificacion){
                            if($identificacion->principal){
                                echo $identificacion->widentificacion->ds_identificacion." ".$identificacion->numero_identificacion;
                            }
                          } ?>                    
                </td>
                <td> <?php foreach ($vinculo->pariente->telefono as $telefono){ 
                                    echo $telefono->wtipo_telefono->tipo_telefono." - (".$telefono->nu_area.")".$telefono->nu_tel."<br/>";
                            }
                            ?>
                </td>
                <td><?php if($vinculo->autorizado) echo "Si"; else echo "No"; ?></td>
                <td><textarea cols="10" rows="1"></textarea></td>
                <td>
                    <div id="icons">
                        <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="alumnosView.deleteRelated(this,<?php echo $alumno->persona->id; ?>,<?php echo $vinculo->pariente_id; ?>);"><span class="ui-icon ui-icon-minus" style="margin: 0 4px;"></span></li>
                    </div>                    
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="insert_form" class="content-center" >
        <div class="subtitle" style="margin-top: 20px">
            Nuevo Vinculo
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
    

