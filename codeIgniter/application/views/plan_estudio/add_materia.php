<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    alumnosView = new AlumnosView();
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'plan_estudios/add_materia'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Alta de Materia
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="year">Materia :</label>
                    <input type="text" id="nueva_materia" name="nueva_materia" onchange="alumnosView.setSelectedIndexByValue('', 'materia_selected')" />
                </div>

                
            </div>            
            <div style="clear: both"></div>

            <div class="row">
                <button onclick="if(alumnosView.submitForm('form',true)){alert('Materia agregada con éxito');return}else{return false;}">Guardar</button>
            </div>
        </div>
    </form>
</div>        