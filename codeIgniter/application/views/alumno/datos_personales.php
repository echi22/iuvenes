
     
        <div class="columna1"> 
                <div class="columna_ajustada">
                    <div class="foto_alumno">
                        <img src="<?php echo base_url().$alumno->persona->foto; ?>" class="foto_alumno" alt="Foto del Alumno">
                    </div>
                </div>
                <div class="columna_ajustada">
                
                    <div class="row">
                        <label class="subtitle" for="dt_nacimiento">Fecha de nacimiento:</label>
                        <p class="data" id="dt_nacimiento"><?php echo $alumno->persona->dt_nac; ?></p>
                    </div>
                    <div class="row">
                        <label class="subtitle" for="nacionalidad">Nacionalidad:</label>
                        <p class="data" ><?php echo $alumno->persona->country->ds_pais; ?></p>
                    </div>
                    <div class="row">
                        <label class="subtitle" for="sexo">Sexo:</label>
                        <p class="data" ><?php echo $alumno->persona->sexo->ds_sexo; ?></p>                   
                    </div>
                    <div class="row">
                        <label class="subtitle" for="establecimiento">Establecimiento:</label>
                        <p class="data" ><?php echo $alumno->establecimiento->ds_establecimiento; ?></p>
                    </div>
                </div>
                
            <div style="clear:both"></div>            
            <div>
                <label class="subtitle">Domicilios:</label>
                <table>
                    <tr class="table_header">
                        <td>
                            Calle
                        </td>
                        <td>
                            Número
                        </td>
                        <td>
                            Entre
                        </td>
                        <td>
                            Piso
                        </td>
                        <td>
                            Depto.
                        </td>
                        <td>
                            Pais
                        </td>
                        <td>
                            Provincia
                        </td>
                        <td>
                            Localidad
                        </td>                        
                    </tr>
                    <?php 
                    $class= "table_row1";
                        foreach($alumno->persona->domicilio as $dom){
                            
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <td>
                            <?php echo $dom->ds_calle ?>
                        </td>
                        <td>
                            <?php echo $dom->ds_numeral; ?>
                        </td>
                        <td>
                            <?php echo $dom->ds_entre1." y ".$dom->ds_entre2; ?>
                        </td>
                        <td>
                            <?php echo $dom->ds_piso; ?>
                        </td>
                        <td>
                            <?php echo $dom->ds_depto; ?>.
                        </td>
                        <td>
                            <?php echo $dom->country->ds_pais; ?>
                        </td>
                        <td>
                            <?php echo $dom->state->ds_provincia; ?>
                        </td>
                        <td>
                            <?php echo $dom->localidad->ds_localidad; ?>
                        </td>    
                    </tr>
                    <?php
                    if($class=="table_row1")
                        $class="table_row2";
                    else
                        $class = "table_row1";
                        }
                     ?>
                </table>
            </div>
        </div>
        <div class="columna1">
            <div class="columna_ajustada">
                <label class="subtitle">Personas Autorizadas</label>
                <table>
                    <tr class="table_header">
                        <td>
                            Apellido
                        </td>
                        <td>
                            Nombre
                        </td>
                        
                        <td>
                            Teléfono
                        </td>
                    </tr>
                    <?php 
                    $class = "table_row2";
                    foreach($alumno->persona->persona_es as $familiar){ 
                        
                       if($familiar->autorizado){
                        if($class == "table_row1")
                            $class = "table_row2";
                        else
                            $class = "table_row1";
                        
                        ?>
                    <tr class="<?php echo $class; ?>">
                        <td>
                            <?php echo $familiar->pariente->apellidos; ?>
                        </td>
                        <td>
                            <?php echo $familiar->pariente->nombres; ?>
                        </td>
                        
                        <td>
                            <?php foreach ($familiar->pariente->telefono as $telefono){ 
                                    echo $telefono->wtipo_telefono->tipo_telefono." - (".$telefono->nu_area.")".$telefono->nu_tel."<br/>";
                            }
                            ?>
                        </td>
                        
                    </tr>
                    <?php } } ?>
                </table>
            </div>
            <div class="columna_ajustada">
                <label class="subtitle">Identificaciones</label>
                <table>
                    <tr class="table_header">
                        <td>
                            Tipo
                        </td>
                        <td>
                            Número
                        </td>
                    </tr>
                    <?php 
                    $class = "table_row2";
                    foreach ($alumno->persona->persona_identificacion as $identificacion){
                        if($class == "table_row1")
                            $class = "table_row2";
                        else
                            $class = "table_row1";
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <td>
                            <?php  echo $identificacion->widentificacion->ds_identificacion; ?>
                        </td>
                        <td>
                            <?php echo $identificacion->numero_identificacion; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            
            <div style="clear:both"></div>
            <div class="columna_ajustada">
                 <label class="subtitle">Teléfonos:</label>
                <table>
                    <tr class="table_header">
                        <td>
                            Tipo
                        </td>
                        <td>
                            Cod. Area
                        </td>
                        <td>
                            Número
                        </td>
                    </tr>
                    <?php 
                    $class = "table_row2";
                    foreach ($alumno->persona->telefono as $telefono){
                        if($class == "table_row1")
                            $class = "table_row2";
                        else
                            $class = "table_row1";
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <td>
                            <?php  echo $telefono->wtipo_telefono->tipo_telefono; ?>
                        </td>
                        <td>
                            <?php echo $telefono->nu_area; ?>
                        </td>
                        <td>
                            <?php echo $telefono->nu_tel; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
<div style="clear: both;"></div>
   
