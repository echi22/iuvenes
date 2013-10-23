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
                Generar cursos automáticamente
            </div>
            <div class="row ">
                    Ciclo Lectivo a partir del que se generarán los nuevos cursos:
                    <input type="text" id="ciclo_lectivo" name="id_ciclo_lectivo" value="<?php echo $parametros['id_ciclo_lectivo']; ?>" />
                                    <button onclick="if(confirm('¿Estás seguro que querés generar los cursos automáticamente a partir del ciclo lectivo '+$('#ciclo_lectivo').val() +'?')){cursosView.submitForm('form');}else{return false;}">Generar</button>

            </div>
            
    </form>
   

</div>