<?php
echo validation_errors();
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/View.js"></script>
<script type="text/javascript">
    view = new View();
</script>
<div id="contenido">
    <form name="form"  action="<?php echo base_url() . 'users/index'; ?>" id="form" method="post">    
        <div id="insert_form" class="content-center">
            <div class="titulo">
                <?php echo $error_message; ?>
            </div>
            
        </div>
    </form>
</div>        