<script type="text/javascript" src="<?php echo base_url(); ?>js/CursosView.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#tabs" ).tabs();});
    cursosView = new CursosView();
    
</script>
<!-- HTML5 TABS CODE -->
<h3 class="titulo">
    Consulta Curso - <?php echo $curso->detalle(); ?>
</h3>
<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#tabs-1">Datos Curso</a></li>
        <li><a href="#tabs-2">Alumnos</a></li>
        <li><a href="#tabs-3">Docentes</a></li>
        <li><a href="#tabs-4">Horarios</a></li>
        <li><a href="#tabs-5">Materias</a></li>


    </ul>
    <div id="tabs-1">
        <?php $this->load->view('curso/modify'); ?>   
    </div>   
    <div id="tabs-2">
        <?php $this->load->view('curso/alumnos'); ?>   
    </div>
    <div id="tabs-3">
        <?php $this->load->view('curso/docentes'); ?> 
    </div>
    <div id="tabs-4">
        <?php $this->load->view('curso/horarios'); ?> 
    </div>
    <div id="tabs-5">
        <?php  $this->load->view('curso/materias'); ?> 
    </div>
</div>
