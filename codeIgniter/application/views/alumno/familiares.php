    <div >
        <table class="content-center">
            <tr class="table_header">
               <td>Apellido</td> <td>Nombre</td> <td>parentesco</td> <td>Identificación</td>
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
                <td><?php echo $vinculo->pariente->apellidos; ?></td>
                <td><?php echo $vinculo->pariente->nombres; ?></td>
                <td>
                    <p id="parentesco_no_edit<?php echo $vinculo->id; ?>" class="no_edit<?php echo $vinculo->id; ?>"> <?php echo $vinculo->parentesco; ?> </p>
                    <input class="edit<?php echo $vinculo->id; ?> hidden" type="text" id="parentesco<?php echo $vinculo->id; ?>" value="<?php echo $vinculo->parentesco; ?>" />
                </td>
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
                <td><p id="autorizado_no_edit<?php echo $vinculo->id; ?>" class="no_edit<?php echo $vinculo->id; ?>"><?php if($vinculo->autorizado) echo "Si"; else echo "No"; ?> </p>
                    <input type="checkbox" <?php if($vinculo->autorizado) echo "checked"; ?>  class="edit<?php echo $vinculo->id; ?> hidden" id="autorizado<?php echo $vinculo->id; ?>"/></td>
                <td><textarea cols="10" rows="1"></textarea></td>
              
                <td>
                    <div class="no_edit<?php echo $vinculo->id; ?> ">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Modificar" onclick="alumnosView.show_editable(<?php echo $vinculo->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="alumnosView.deleteRelated(this,<?php echo $vinculo->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
                        </div>    
                    </div>
                    <div class="edit<?php echo $vinculo->id; ?> hidden">
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Guardar" onclick="alumnosView.edit_related(<?php echo $vinculo->id; ?>,<?php echo $alumno->persona->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
                        </div> 
                        <div id="icons" style="float: left">
                            <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="alumnosView.hide_editable(<?php echo $vinculo->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
                        </div>    
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
    

