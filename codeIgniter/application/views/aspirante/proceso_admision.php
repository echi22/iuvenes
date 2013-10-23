<script type="text/javascript" src="<?php echo base_url(); ?>js/AspiranteView.js"></script>
<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
    });
    aspiranteView = new AspiranteView();
    aspiranteView.loadView("get_all_from_year",{'ciclo_lectivo':2014});
    aspiranteView.loadView("get_inscriptos");
    aspiranteView.loadView("get_preadmitidos_fase1");
    aspiranteView.loadView("get_preadmitidos_fase2");
    aspiranteView.loadView("get_preadmitidos_fase3");
    aspiranteView.loadView("get_admitidos");
    aspiranteView.addMarkAsChangedHandler();
</script>
<!-- HTML5 TABS CODE -->
<h3 class="titulo">
    Proceso de Admisión de Alumnos Nuevos
</h3>
<div id="tabs" style="width: 100%">
    <ul>
        <li><a href="#get_all_from_year">Ver todos los del ciclo lectivo</a></li>
        <li><a href="#get_inscriptos">Inscriptos</a></li>
        <li><a href="#get_preadmitidos_fase1"><b>1</b> - Completa Dirección del Nivel</a></li>
        <li><a href="#get_preadmitidos_fase2"><b>2</b> - Completa Administación</a></li>
        <li><a href="#get_preadmitidos_fase3"><b>3</b> - Completa Secretaría del Nivel</a></li>
        <li><a href="#get_admitidos"><b>4</b> - Admitidos</a></li>
    </ul>
    <div id="get_all_from_year">   
    </div>
    <div id="get_inscriptos">   
    </div>
    <div id="get_preadmitidos_fase1"> 
    </div>
    <div id="get_preadmitidos_fase2"> 
    </div>
    <div id="get_preadmitidos_fase3"> 
    </div>
    <div id="get_admitidos"> 
    </div>
</div>
