<script type="text/javascript" src="<?php echo base_url(); ?>js/AlumnosView.js"></script>
<script type="text/javascript">
        $(function(){
            // Fast and dirty
            $('article.tabs section > h4').click(function(){
                $('article.tabs section').removeClass('current');
                $(this)
                .closest('section').addClass('current');
            });
        });
    alumnosView = new AlumnosView();
    
    </script>
<!-- HTML5 TABS CODE -->
<div id="contenido">
    <h3 class="titulo">
        Consulta Alumno - <?php echo $alumno->persona->apellidos." ".$alumno->persona->nombres; ?>
    </h3>
    <article class="tabs">
        <section class="current">
            <h4>Datos personales</h4>
            <div class="div_tab">
                <?php $this->load->view('alumno/datos_personales'); ?>
            </div>
        </section>
        <section >
            <h4>Personas vinculadas</h4>
            <div class="div_tab">
                <?php $this->load->view('alumno/familiares'); ?>
            </div>
        </section>
        <section>
            <h4>Trayecto escolar</h4>
            <div class="div_tab">
                <?php //$this->load->view('personas_vinculadas'); ?>
            </div>
        </section>
    </article>
    <!-- /HTML5 TABS CODE -->
</div>

</body>
</html>