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
    
</script>
<div class="table">
    <div>
        <label>Ver todo</label><input type="checkbox" id="ver_todo" checked="true" onclick="cursosView.toogle_all_trimestres(this)"/>
        <label>Ver 1 trimestre</label><input type="checkbox" id="1_trimestre" checked="true" onclick="cursosView.toogle_trimestre(1,this)"/>
        <label>Ver 2 trimestre</label><input type="checkbox" id="2_trimestre" checked="true" onclick="cursosView.toogle_trimestre(2,this)"/>
        <label>Ver 3 trimestre</label><input type="checkbox" id="3_trimestre" checked="true" onclick="cursosView.toogle_trimestre(3,this)"/>
    </div>
    <div>
        <label>Ver todo</label><input type="checkbox" id="ver_todo" checked="true" onclick="cursosView.toogle_all_trimestres(this)"/>
        <?php
        foreach ($curso->anio_nivel->materiums->get() as $materia) {
            ?>
            <label><?php echo $materia->nombre; ?></label><input type="checkbox" id="<?php echo str_replace(" ", "_", $materia->nombre); ?>" checked="true" onclick="cursosView.toogle_materia('<?php echo str_replace(" ", "_", $materia->nombre); ?>',this)"/>
            <?php
        }
        ?>       
    </div>
    <div id="table-container">
    <table class="content-center tablesorter" id="tabla_fixed" >
        <thead>
            <tr class="table_header">
                <th>Resaltar</th><th>Apellidos</th><th>Nombres</th>
                <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <td class="<?php echo $i; ?> td_container">
                        <table>
                            <tr>
                                <th style="text-align: center" class="todos" colspan="<?php echo count($curso->anio_nivel->materiums->get()->all_to_array()); ?>">
                                    <?php echo $i; ?> trimestre
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

                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                        <td class="<?php echo $i; ?> td_container" style="white-space: nowrap; ">
                            <table>                                
                                <tr>
                                    <?php
                                    foreach ($curso->anio_nivel->materiums->get() as $materia) {
                                        echo "<td class='" . $i . " " . str_replace(" ", "_", $materia->nombre) . " trimestre" . $i . " todos' style='max-width:60px;min-width:60px;'><input style='max-width:60px;min-width:60px;' type='text' /></td>";
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
<div id="bottom_anchor"></div>
</div>
    <div style="clear: both"></div>
    <?php include('application/views/templates/pager.php'); ?>
</div>