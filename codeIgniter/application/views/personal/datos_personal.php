<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/PersonalesView.js"></script>
<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
    });
    alumnosView = new AlumnosView();
    personalesView = new PersonalesView();

</script>
<h3 class="titulo">
    Consulta Personal - <?php echo $personal->persona->apellidos . " " . $personal->persona->nombres; ?>
</h3>
<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#tabs-1">Datos Personales</a></li>
        <li><a href="#tabs-2">Prestaciones</a></li>
        <li><a href="#tabs-3">Licencias</a></li>
        <li><a href="#tabs-5">Adelantos</a></li>
        <li><a href="#tabs-4">Períodos de Vigencia</a></li>
    </ul>
    <div id="tabs-1">
        <?php $this->load->view('personal/modify'); ?>   
    </div>
    <div id="tabs-2">
        <?php $this->load->view('personal/prestaciones'); ?>
    </div>
    <div id="tabs-3">
        <?php $this->load->view('personal/licencias'); ?>
    </div>
    <div id="tabs-5">
        <?php $this->load->view('personal/adelantos'); ?>
    </div>
    <div id="tabs-4">
        <?php $this->load->view('personal/periodos_vigencia'); ?>
    </div>

</div>
