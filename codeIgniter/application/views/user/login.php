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
                Login
            </div>
            <div class="row border_top">
                <div class="input">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" class="required" required/>
                </div>   
                <div class="input">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="required" required/>
                </div>   
            </div>            
            <div style="clear: both"><?php echo $message; ?></div>
            
            <div class="row">
                <button onclick="return view.submitForm('form',true)">Entrar</button>
            </div>
        </div>
    </form>
</div>        