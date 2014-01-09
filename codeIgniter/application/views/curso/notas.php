<script type="text/javascript">
    function moveScroll(){
        var scroll = $(window).scrollTop();
        var anchor_top = $("#tabla_fixed").offset().top;
        var anchor_bottom = $("#bottom_anchor").offset().top;
        if (scroll>anchor_top && scroll<anchor_bottom) {
            clone_table = $("#clone");
            if(clone_table.length == 0){
                clone_table = $("#tabla_fixed").clone();
                clone_table.attr('id', 'clone');
                clone_table.css({position:'fixed',
                    'pointer-events': 'none',
                    top:'-12px'});
                clone_table.width($("#tabla_fixed").width());
                $("#table-container").append(clone_table);
                $("#clone").css({visibility:'hidden'});
                $("#clone thead").css({visibility:'visible'});
            }
        } else {
            $("#clone").remove();
        }
    }
    $(window).scroll(moveScroll);
    $(document).ready(function()
    {
        $(".cuerpo").addClass("cuerpo_ancho");
        $(".cuerpo_ancho").removeClass("cuerpo");
        $("#new_trimestre").dialog({
            autoOpen: false,
            show: {
                effect: "fade",
                duration: 1000
            },
            hide: {
                effect: "fade",
                duration: 1000
            }
        });
        $("#new_trimestre").hide();
    });
    function abrir_popup(){
        $("#new_trimestre").dialog("open");
    };
     
</script>
<div class="table">
    <div>
        <?php
        // for ($i = 1; $i <= 3; $i++) { 
        foreach ($curso->trimestres as $i => $trimestre) {
            ?>
            <label><?php echo $trimestre->nombre; ?></label><input type="checkbox" class="check_trimestre" id="<?php echo $i; ?>_trimestre" checked="true" onclick="cursosView.toogle_trimestre(<?php echo $i; ?>,this)"/>
            
        <?php } ?>
        <label>Nuevo trimestre</label><input type="checkbox" class="check_trimestre" id="abrir_nuevo_trimestre" onclick="abrir_popup()"/>

    </div>
    <div>
        <?php
        foreach ($curso->anio_nivel->materiums->get() as $materia) {
            ?>
            <label><?php echo $materia->nombre; ?></label><input type="checkbox" id="<?php echo str_replace(" ", "_", $materia->nombre); ?>" checked="true" onclick="cursosView.toogle_materia('<?php echo str_replace(" ", "_", $materia->nombre); ?>',this)"/>
            <?php
        }
        ?>       
    </div>
    <div id="table-container">
        <form id="form" action="<?php echo base_url() . 'cursos/save_notas'; ?>" method="post">
            <input type="hidden" name="curso_id" value="<?php echo $curso->id; ?>" />
            <table class="content-center tablesorter" id="tabla_fixed" >
                <thead>
                    <tr class="table_header">
                        <th>Resaltar</th><th>Apellidos</th><th>Nombres</th>
                        <?php
                        // for ($i = 1; $i <= 3; $i++) { 
                        foreach ($curso->trimestres as $i => $trimestre) {
                            ?>
                            <td class="<?php echo $i; ?> td_container">
                                <table>
                                    <tr>
                                        <th style="text-align: center" class="todos" colspan="<?php echo count($curso->anio_nivel->materiums->get()->all_to_array()); ?>">
                                            <?php echo $trimestre->nombre; ?> 
                                        </th>
                                    </tr>
                                    <tr>
                                        <?php
                                        foreach ($curso->anio_nivel->materiums->get() as $materia) {
                                            echo "<th class='todos " . str_replace(" ", "_", $materia->nombre) . "' style='max-width:60px; min-width:60px; '>" . $materia->nombre . "</th>";
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </td>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array("odd", "even");
                    foreach ($curso->alumnos as $i => $a) {
                        ?>
                        <tr class="<?php echo $class[($i % 2)]; ?> alumno">
                            <td style="width: 100px"><div id="icons">

                                    <input type="checkbox" class="seleccionado" onclick="cursosView.set_alumnos_seleccionados()"/>
                            </td>
                            <td style="width: 100px"><?php echo $a->persona->apellidos; ?></td>
                            <td style="width: 100px"><?php echo $a->persona->nombres; ?></td>

                            <?php
                            // for ($i = 1; $i <= 3; $i++) { 
                            foreach ($curso->trimestres as $i => $trimestre) {
                                ?>
                                <td class="<?php echo $i; ?> td_container" style="white-space: nowrap; ">
                                    <table>                                
                                        <tr>
                                            <?php
                                            foreach ($curso->anio_nivel->materiums->get() as $materia) {
                                                $nota = new Nota();
                                                $nota->where('materium_id', $materia->id)->where('alumno_id', $a->id)->where('trimestre_id', $trimestre->id)->get();
                                                echo "<td class='" . $i . " " . str_replace(" ", "_", $materia->nombre) . " trimestre" . $i . " todos' style='max-width:60px;min-width:60px;'><input style='max-width:60px;min-width:60px;' type='text' name='" . $a->id . "_" . $trimestre->id . "_" . $materia->id . "' value='" . $nota->nota . "' /></td>";
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </td>
                            <?php } ?>
                            <td style="width: 100%; visibility: hidden"></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button onclick="cursosView.submitForm('form')">Guardar</button>
        </form>
        <div id="bottom_anchor"></div>
    </div>
    <div style="clear: both"></div>
    <?php include('application/views/templates/pager.php'); ?>
</div>


<div id="new_trimestre" title="Agregar trimestre" >
    <form action="<?php echo base_url() . 'cursos/new_trimestre'; ?>" method="post">
        <span id="message"></span><br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" /><br>
        <input type="hidden" name="curso_id" value="<?php echo $curso->id; ?>" />
        <input type="submit" id="cambiarBoton" value="Guardar" style="cursor: pointer;"/>
    </form>
</div>