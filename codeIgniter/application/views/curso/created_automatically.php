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
                    <p>Los cursos fueron generados automáticamente.</p>
                    <a href="<?php echo base_url() . 'cursos/buscar'?>">Buscar Cursos </a> 
                    

            </div>
            
    </form>
   

</div>