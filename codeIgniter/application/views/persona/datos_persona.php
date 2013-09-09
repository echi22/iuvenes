<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
    });
    alumnosView = new AlumnosView();

</script>
<!-- HTML5 TABS CODE -->
<h3 class="titulo">
    Consulta Persona - <?php echo $persona->apellidos . " " . $persona->nombres; ?>
</h3>
<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#tabs-1">Datos Personales</a></li>
        <li><a href="#tabs-2">Personas Vinculadas</a></li>
    </ul>
    <div id="tabs-1">
<?php $this->load->view('persona/modify'); ?>   
    </div>
    <div id="tabs-2">
<?php $this->load->view('persona/familiares'); ?>
    </div>    
</div>
