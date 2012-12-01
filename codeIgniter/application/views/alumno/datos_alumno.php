<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
      $(function() {
    $( "#tabs" ).tabs();});
    alumnosView = new AlumnosView();
    
    </script>
<!-- HTML5 TABS CODE -->
    <h3 class="titulo">
        Consulta Alumno - <?php echo $alumno->persona->apellidos." ".$alumno->persona->nombres; ?>
    </h3>
<div id="tabs" style="width: 100%">
        <ul>
            <li><a href="#tabs-1">Datos Personales</a></li>
            <li><a href="#tabs-2">Personas Vinculadas</a></li>
            <li><a href="#tabs-3">Trayecto Escolar</a></li>
        </ul>
        <div id="tabs-1">
            <?php $this->load->view('alumno/datos_personales'); ?>   
        </div>
        <div id="tabs-2">
            <?php $this->load->view('alumno/familiares'); ?>
        </div>
        <div id="tabs-3">
            <?php //$this->load->view('personas_vinculadas'); ?>
        </div>
    </div>
<!--    <article class="tabs">
        <section class="current">
            <h4>Datos personales</h4>
            <div class="div_tab">
               
            </div>
        </section>
        <section >
            <h4>Personas vinculadas</h4>
            <div class="div_tab">
            </div>
        </section>
        <section>
            <h4>Trayecto escolar</h4>
            <div class="div_tab">
            </div>
        </section>
    </article>-->
    <!-- /HTML5 TABS CODE -->
