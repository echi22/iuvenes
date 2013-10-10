<style type="text/css">
    .left{
        width:120px;
        float:left;
    }
    .left table{
        background:#E0ECFF;
    }
    .left td{
        background:#eee;
    }
    .right{
        float:right;
        width:600px;
    }
    .right table{
        background:#E0ECFF;
        width:100%;
    }
    .right td{
        background:#fafafa;
        text-align:center;
        padding:2px;
    }
    .right td{
        background:#E0ECFF;
    }
    .right td.drop{
        background:#fafafa;
        width:100px;
    }
    .right td.over{
        background:#FBEC88;
    }
    .item{
        text-align:center;
        border:1px solid #499B33;
        width:100px;
    }
    .assigned{
        border:1px solid #BC2A4D;
    }

</style>
<script>
    function dropOnChild(ev){
        var data=ev.dataTransfer.getData("Text");
        var node = document.getElementById(data).cloneNode(true);
        node.ondrop = dropOnChild;
        this.parentNode.appendChild(node)        
        this.parentNode.removeChild(this);
    }
    function drop(ev)
    {
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        var node=document.getElementById(data).cloneNode(true);
         
        var res = cursosView.checkProfessorFree(<?php echo $curso->id; ?>,node.id,ev.currentTarget.id);
        if( res !== "true"){
            if(confirm(cursosView.errorMessage +" \n¿Estás seguro de que querés agregar la materia en este horario?")){
                node.ondrop = dropOnChild;
                if ( ev.target.hasChildNodes() )
                {
                    while ( ev.target.childNodes.length >= 1 )
                    {
                        ev.target.removeChild( ev.target.firstChild );       
                    } 
                }        
                ev.target.appendChild(node);
                cursosView.addMateriaToHour(node.id,ev.currentTarget.id);
            }
        }else{
            node.ondrop = dropOnChild;
                if ( ev.target.hasChildNodes() )
                {
                    while ( ev.target.childNodes.length >= 1 )
                    {
                        ev.target.removeChild( ev.target.firstChild );       
                    } 
                }        
            ev.target.appendChild(node);
            cursosView.addMateriaToHour(node.id,ev.currentTarget.id);
        }

        
    }
    function allowDrop(ev)
    {
        ev.preventDefault();
    }
    function drag(ev)
    {
        ev.dataTransfer.setData("Text",ev.target.id);
    }    
    $.contextMenu({
        selector: '.drop', 
        callback: function(key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m); 
        },
        items: {            
            "delete": {name: "Eliminar", icon: "delete", callback: function(key, opt){ opt.$trigger.html(""); }}           
        }
    });
    function eliminar(){
        $(this).remove();
    }
    $('.drop').on('click', function(e){
        console.log('clicked', this);
    })
</script>

<div style="width:750px; height: 100%">
    <div class="left">
        <table>
            <tr>
                <td><div class="" draggable="false">Materias</div></td>
            </tr>     
            <?php foreach ($curso->anio_nivel->materiums->get() as $materia) { ?>
                <tr>          
                    <td><div class="item <?php echo str_replace(' ', '', $materia->nombre); ?>" style="background: <?php echo $materia->color; ?>"  id="<?php echo $materia->id; ?>" style="cursor: pointer;" ondragstart="drag(event)" draggable="true"  ><?php echo $materia->nombre; ?></div></td>

                </tr>            
            <?php } ?>
        </table>
    </div>
    <div class="right">

        <table id="table">

            <?php $dias = array("lunes", "martes", "miercoles", "jueves", "viernes"); ?>
            <tr>
                <td class="blank"></td>
                <td class="title">Lunes</td>
                <td class="title">Martes</td>
                <td class="title">Miercoles</td>
                <td class="title">Jueves</td>
                <td class="title">Viernes</td>
            </tr>
            <?php foreach ($curso->horarios as $hora) {
                ?>

                <tr>
                    <td class="time"><?php echo $hora->hora->hora; ?></td>     
                    <?php
                    foreach ($dias as $dia) {
                        $horaArray = (array) $hora;
                        $m = $horaArray[$dia];
                        if ($m != null) {
                            $materia = new Materium();
                            $materia->where('id', $m)->get();
                            ?>
                            <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)" id="<?php echo $dia . '_' . $hora->hora->id; ?>"><div class="item <?php echo str_replace(' ', '', $materia->nombre); ?>" style="background: <?php echo $materia->color; ?>"  id="<?php echo $materia->id; ?>" style="cursor: pointer;" ondragstart="drag(event)" draggable="true"  ><?php echo $materia->nombre; ?></div></td>
                        <?php } else { ?>

                            <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)" id="<?php echo $dia . '_' . $hora->hora->id; ?>"></td>
                            <?php
                        }
                    }
                    ?>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>
<div style="clear: both"></div>
<div class="row" style="padding-top: 20px">
    <input type="hidden" value="si" name="busqueda"/>
    <button onclick="cursosView.saveHorariosModifications(<?php echo $curso->id; ?>)">Guardar</button>
</div>