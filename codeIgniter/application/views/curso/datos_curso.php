<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
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
            
        </ul>
        <div id="tabs-1">
            <?php $this->load->view('alumno/modify'); ?>   
        </div>
        
    </div>
