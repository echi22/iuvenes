<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
    });
    alumnosView = new AlumnosView();

</script>
<!-- HTML5 TABS CODE -->
<h3 class="titulo">
    Consulta Aspirante - <?php echo $aspirante->persona->apellidos . " " . $aspirante->persona->nombres; ?>
</h3>
<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#tabs-1">Datos Personales</a></li>
        <li><a href="#tabs-2">Personas Vinculadas</a></li>
    </ul>
    <div id="tabs-1">
        <?php $this->load->view('aspirante/modify_aspirante'); ?>   
    </div>
    <div id="tabs-2">
        <?php $this->load->view('aspirante/familiares'); ?>
    </div>
</div>
