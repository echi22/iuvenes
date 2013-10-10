<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    cursosView = new CursosView();
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter().tablesorterPager({container: $("#pager")}); 
    } 
); 
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'cursos/generate_cursos_automatically'; ?>" method="post">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Crear automaticamente
            </div>
            <div class="row ">
                <div class="input">
                    <label for="ciclo_lectivo">Ciclo Lectivo:</label>
                    <input type="text" id="ciclo_lectivo" name="id_ciclo_lectivo" value="<?php echo $parametros['id_ciclo_lectivo']; ?>" />
                </div>
            </div>
            <div class="row" style="padding-top: 20px">
                <input type="hidden" value="si" name="busqueda"/>
                <button onclick="cursosView.submitForm('form')">Buscar</button>
            </div>
            <div style="clear: both"></div>
    </form>
   

</div>