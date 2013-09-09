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
    <form id="form"  action="<?php echo base_url() . 'users/user_data/'.$user->id; ?>" id="form" method="post">
        
        <div id="insert_form" class="content-center">
            <div class="titulo border_bottom">
                Datos del usuario
            </div>
            
            <div class="row ">
                <div class="input">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" value="<?php echo $user->apellidos; ?>" id="apellidos" name="apellidos" class="required" required/>
                </div>
                <div class="input">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" value="<?php echo $user->nombres; ?>" name="nombres" class="required" required/>
                </div>
            </div>
           
            <div class="row">
                <div class="input">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" value="<?php echo $user->username; ?>" name="username" class="required" required/>
                </div>
                <div class="input">
                    <label for="mail">Mail:</label>
                    <input type="text" id="mail" name="mail" value="<?php echo $user->email; ?>" class="required" required/>
                </div> 
            </div>
            <div class="row">
                <div class="input">
                    <label for="password">Contraseña(*):</label>
                    <input type="password" id="password" name="password" />
                </div>    
                <div class="input">
                    <label for="passconf">Confirmar contraseña(*):</label>
                    <input type="password" id="passconf" name="passconf" />
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
                    <script type="text/javascript">
                        usersView.setSelectedIndexByValue('<?php echo $user->group->id; ?>', 'group');
                    </script>
                </div>                                
            </div>
            <div class="row">
                <button onclick="return usersView.submitForm('form', true)">Guardar</button>
            </div>
            
            <div class="row">
                <label>(*)Si no se desea cambiar la contraseña dejar estos campos en blanco</label>
            </div>
        </div>
    </form>
</div>        