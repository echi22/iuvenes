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
        background:#fafafa;
        width:100px;
    }
    .assigned{
        border:1px solid #BC2A4D;
    }

</style>
<script>
    cursosView = new CursosView();
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
        node.ondrop = dropOnChild;
        if ( ev.target.hasChildNodes() )
        {
            while ( ev.target.childNodes.length >= 1 )
            {
                ev.target.removeChild( ev.target.firstChild );       
            } 
        }        
        ev.target.appendChild(node);
    }
    function allowDrop(ev)
    {
        ev.preventDefault();
    }
    function drag(ev)
    {
        ev.dataTransfer.setData("Text",ev.target.id);
    }    
</script>

<div style="width:750px; height: 100%">
    <div class="left">
        <table>
            <tr>
                <td><div class="item" id="english" ondragstart="drag(event)" draggable="true"  >Inglés</div></td>
            </tr>
            <tr>
                <td><div class="item" id="Science" ondragstart="drag(event)" draggable="true">Cs. Sociales</div></td>
            </tr>
            <tr>
                <td><div class="item" id="Music" ondragstart="drag(event)" draggable="true">Música</div></td>
            </tr>
            <tr>
                <td><div class="item" id="History"  ondragstart="drag(event)" draggable="true">Historia</div></td>
            </tr>
            <tr>
                <td><div class="item" id="Computer" ondragstart="drag(event)" draggable="true">Computación</div></td>
            </tr>
            <tr>
                <td><div class="item" id="Mathematics" ondragstart="drag(event)" draggable="true">Matemática</div></td>
            </tr>
            <tr>
                <td><div class="item" id="Arts" ondragstart="drag(event)" draggable="true">Lengua</div></td>
            </tr>
            <tr>
                <td><div class="item" id="Ethics" ondragstart="drag(event)" draggable="true">Cs.Naturales</div></td>
            </tr>
        </table>
    </div>
    <div class="right">

        <table id="table">

            <?php if ($curso->scheduletable->html == "") { ?>
                <tr>
                    <td class="blank"></td>
                    <td class="title">Monday</td>
                    <td class="title">Tuesday</td>
                    <td class="title">Wednesday</td>
                    <td class="title">Thursday</td>
                    <td class="title">Friday</td>
                </tr>
                <tr>
                    <td class="time">08:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td class="time">09:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td class="time">10:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td class="time">11:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td class="time">12:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
    <!--            <tr>
                    <td class="time">13:00</td>
                    <td class="lunch" colspan="5">Lunch</td>
                </tr>-->
                <tr>
                    <td class="time" >14:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td class="time">15:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td class="time">16:00</td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
            </table>
<?php } else {
    echo $curso->scheduletable->html;
    echo "</table>";
} ?>
    </div>
</div>
<div style="clear: both"></div>
<div class="row" style="padding-top: 20px">
    <input type="hidden" value="si" name="busqueda"/>
    <button onclick="cursosView.saveHorarios(<?php echo $curso->id; ?>)">Guardar</button>
</div>