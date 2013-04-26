<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/View.js"></script>
<script type="text/javascript">
    view = new View();
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'establecimientos/create'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Establecimiento
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="ds_establecimientos">Nombre:</label>
                    <input type="text" id="ds_establecimiento" name="ds_establecimiento" class="required"/>
                </div>                
            </div>            
            <div style="clear: both"></div>
            
            <div class="row">
                <button onclick="return view.submitForm('form',true)">Guardar</button>
            </div>
        </div>
    </form>
</div>        