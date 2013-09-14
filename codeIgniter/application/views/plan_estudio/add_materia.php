<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/PlanEstudioView.js"></script>
<script type="text/javascript">
    planEstudioView = new PlanEstudioView();
</script>
<div id="contenido">

    <div id="insert_form" class="content-center">
        <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_materia'; ?>" id="form" method="post">    
            <div class="titulo">
                Alta de Materia
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="year">Materia :</label>
                    <input type="text" id="nueva_materia" name="nueva_materia" onchange="alumnosView.setSelectedIndexByValue('', 'materia_selected')" />
                </div>
                <div class="input"> 
                    <label for="color">Color:</label>
                    <input type="color" id="color" name="color" />
                </div>


            </div>            
            <div style="clear: both"></div>

        </form>
        <div class="row">
            <button onclick="if(planEstudioView.check_inputs('form',true)){alert('Materia agregada con éxito');return}else{return false;}">Guardar</button>
            <button onclick="window.location.href = 'show_materium'">Volver</button>

        </div>
    </div>
</div>        