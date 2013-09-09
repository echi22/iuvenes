<?php
echo validation_errors();
?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/UsersView.js"></script>
<script type="text/javascript">
    usersView = new UsersView();
</script>
<style>
    .prev_container{
        overflow: auto;
        width: 200px;
        height: 250px;
    }

    .prev_thumb{
        margin: 10px;
        max-width: 200px;
        height: 200px;
    }
</style>
<div id="contenido">
    <form id="form"  action="<?php echo base_url() . 'users/register'; ?>" id="form" method="post">
        <?php echo form_open_multipart('users/register'); ?>
        <div id="insert_form" class="content-center">
            <div class="titulo border_bottom">
                Alta de Usuario
            </div>
            
            <div class="row ">
                <div class="input">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="required" required/>
                </div>
                <div class="input">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" class="required" required/>
                </div>
            </div>
           
            <div class="row">
                <div class="input">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" class="required" required/>
                </div>
                <div class="input">
                    <label for="mail">Mail:</label>
                    <input type="text" id="mail" name="mail" class="required" required/>
                </div> 
            </div>
            <div class="row">
                <div class="input">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="required" required/>
                </div>    
                <div class="input">
                    <label for="passconf">Confirmar contraseña:</label>
                    <input type="password" id="passconf" name="passconf" class="required" required/>
                </div> 
            </div>
           
           <div class="row">
                <div class="input">
                    <label for="group">Rol:</label>
                    <select id="group" name="group" class="required" required>
                         {grupos}
                         <option value="{id}">{description}</option>
                         {/grupos}
                     </select>
                </div>                                
            </div>
            <div class="row">
                <button onclick="return alumnosView.submitForm('form', true)">Guardar</button>
            </div>
        </div>
    </form>
</div>        