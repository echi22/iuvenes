<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
      $(function() {
    $( "#tabs" ).tabs();});
    alumnosView = new AlumnosView();
    
</script>
    <h3 class="titulo">
        Consulta Personal - <?php echo $personal->persona->apellidos." ".$personal->persona->nombres; ?>
    </h3>
<div id="tabs" style="width: 100%">
        <ul>
            <li><a href="#tabs-1">Datos Personales</a></li>
            <li><a href="#tabs-2">Personas Vinculadas</a></li>
            <li><a href="#tabs-3">Trayecto Escolar</a></li>
        </ul>
        <div id="tabs-1">
            <?php $this->load->view('personal/modify'); ?>   
        </div>
        <div id="tabs-2">
            <?php //$this->load->view('personal/prestaciones'); ?>
        </div>
        <div id="tabs-3">
            <?php //$this->load->view('personas_vinculadas'); ?>
        </div>
    </div>
