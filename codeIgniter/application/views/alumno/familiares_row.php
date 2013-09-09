<?php
if ($vinculo->pariente->id == $alumno->persona->id) {
    $p = $vinculo->persona;
} else {
    $p = $vinculo->pariente;
}

//$apellidos = ($vinculo->pariente->id == $alumno->persona->id) ? $vinculo->persona->apellidos : $vinculo->pariente->apellidos;
//$nombres = ($vinculo->pariente->id == $alumno->persona->id) ? $vinculo->persona->nombres : $vinculo->pariente->nombres;
//$identificacion = ($vinculo->pariente->id == $alumno->persona->id) ? $vinculo->persona->get_identificacion_principal() : $vinculo->pariente->get_identificacion_principal();
//$telefonos = ($vinculo->pariente->id == $alumno->persona->id) ? $vinculo->persona->get_identificacion_principal() : $vinculo->pariente->get_identificacion_principal();
?>


<tr class="<?php echo $class[($i % 2)]; ?> familiar">
    <td><p><?php echo $p->apellidos; ?></p></td>
    <td><p><?php echo $p->nombres; ?></p></td>
    <td>
        <p id="parentesco_no_edit<?php echo $vinculo->id; ?>" class="no_edit_<?php echo $vinculo->id; ?>"> <?php echo $vinculo->parentesco; ?> </p>
        <input class="edit_<?php echo $vinculo->id; ?> hidden" type="text" id="parentesco<?php echo $vinculo->id; ?>" value="<?php echo $vinculo->parentesco; ?>" />
    </td>
    <td><?php
foreach ($p->persona_identificacion as $identificacion) {
    if ($identificacion->principal) {
        echo "<p>" . $identificacion->widentificacion->ds_identificacion . " " . $identificacion->numero_identificacion . "</p>";
    }
}
?>                    
    </td>
    <td> <?php
        foreach ($p->telefono as $telefono) {
            echo "<p>" . $telefono->wtipo_telefono->tipo_telefono . " - (" . $telefono->nu_area . ")" . $telefono->nu_tel . "</p>";
        }
?>
    </td>
    <td><p id="autorizado_no_edit<?php echo $vinculo->id; ?>" class="no_edit_<?php echo $vinculo->id; ?>"><?php
        if ($vinculo->autorizado)
            echo "Si";
        else
            echo "No";
?> </p>
        <input type="checkbox" <?php if ($vinculo->autorizado) echo "checked"; ?>  class="edit_<?php echo $vinculo->id; ?> hidden" id="autorizado<?php echo $vinculo->id; ?>"/></td>
    <td><textarea cols="10" rows="1"></textarea></td>

    <td>
        <div class="no_edit_<?php echo $vinculo->id; ?> ">
            <div id="icons" style="float: left">
                <li class="ui-state-default ui-corner-all" title="Modificar" onclick="alumnosView.show_editable(<?php echo $vinculo->id; ?>);"><span class="ui-icon ui-icon-pencil" style="margin: 0 4px;"></span></li>
            </div> 
            <div id="icons" style="float: left">
                <li class="ui-state-default ui-corner-all" title="Eliminar" onclick="alumnosView.deleteRelated(this,<?php echo $vinculo->id; ?>);"><span class="ui-icon ui-icon-trash" style="margin: 0 4px;"></span></li>
            </div>    
        </div>
        <div class="edit_<?php echo $vinculo->id; ?> hidden">
            <div id="icons" style="float: left">
                <li class="ui-state-default ui-corner-all" title="Guardar" onclick="alumnosView.edit_related(<?php echo $vinculo->id; ?>,<?php echo $alumno->persona->id; ?>);"><span class="ui-icon ui-icon-check" style="margin: 0 4px;"></span></li>
            </div> 
            <div id="icons" style="float: left">
                <li class="ui-state-default ui-corner-all" title="Cancelar" onclick="alumnosView.hide_editable(<?php echo $vinculo->id; ?>);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>
            </div>    
        </div>
    </td>
</tr>