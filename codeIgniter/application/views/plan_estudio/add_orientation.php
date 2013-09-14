<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/View.js"></script>
<script type="text/javascript">
    view = new View();
</script>
<div id="contenido">
    <div id="insert_form" class="content-center">
        <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_orientation'; ?>" id="form" method="post">    

            <div class="titulo">
                Alta de Orientación
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="ds_orientation">Nombre:</label>
                    <input type="text" id="ds_orientation" name="ds_orientation" class="required" required/>
                </div>                
            </div>            
            <div style="clear: both"></div>
        </form>

        <div class="row">
            <button onclick="if(view.submitForm('form',true)){alert('Orientación agregada con éxito');return true;}else{return false;}">Guardar</button>
            <button onclick="window.location.href = 'show_orientation'">Volver</button>

        </div>
    </div>
</div>        