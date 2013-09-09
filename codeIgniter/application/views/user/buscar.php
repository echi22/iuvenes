<script type="text/javascript" src="<?php echo base_url(); ?>js/UsersView.js"></script>
<script type="text/javascript">
    usersView = new UsersView();
    $(document).ready(function()
    {
        $("#popup_vigente").dialog({
            autoOpen: false,
            show: {
                effect: "fade",
                duration: 1000
            },
            hide: {
                effect: "fade",
                duration: 1000
            }
        });
        $("#popup_vigente").hide();
        $("#myTable").tablesorter();
        alumnosView.actualPage = <?php echo (isset($page)) ? $page : 0; ?>;
        alumnosView.setUpPaginator("pager");
        
    }
    );
</script>
<div id="contenido">
    <form id="form" action="<?php echo base_url() . 'users/buscar'; ?>" method="post">
        <div id="insert_form" class="content-center">
            <div class="titulo">
                Búsqueda de Usuarios
            </div>
            <div class="row border_top border_bottom" style="vertical-align: bottom">
                <div class="input">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?php echo $parametros['apellidos']; ?>" />
                </div>
                <div class="input">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" id="nombres" value="<?php echo $parametros['nombres']; ?>"/>
                </div>
                <div class="input">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" name="username" id="username" value="<?php echo $parametros['username']; ?>" />
                </div>
                <div class="input">
                    <label for="mail">Mail</label>
                    <input type="text" name="mail" id="mail" value="<?php echo $parametros['mail']; ?>"/>
                </div>               
                <div class="div_input_chico">
                    <label for="vigente">Estado:</label>
                    <select id="vigente" name="vigente">
                        <option value="1">Vigentes</option>
                        <option value="0">No Vigentes</option>
                    </select>
                    <script type="text/javascript">
                        alumnosView.setSelectedIndexByValue('<?php echo $parametros[vigente]; ?>', 'vigente');
                    </script>
                </div>    
            </div>
            <div class="row">
                <div class="input" style="padding-top: 20px">
                    <input type="hidden" value="<?php if(isset($page)){echo $page;}else{echo 1; } ?>" name="page" id="page"/>
                    <input type="hidden" value="<?php if(isset($last_page)){echo $last_page;}else{echo 1; } ?>" name="last_page" id="last_page"/>

                    <input type="hidden" value="si" name="busqueda"/>
                    <button onclick="alumnosView.submitForm('form')">Buscar</button>
                </div>
            </div>
        </div>
    </form>
    <?php if (isset($users)) { ?>
        <div style="width:90%; margin: auto;">
            <table class="content-center tablesorter" id="myTable">
                <thead>
                    <tr class="table_header">
                        <th>Apellidos</th><th>Nombres</th><th>Nombre de usuario</th><th>Mail</th><th>Rol</th><th>Estado</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = Array("odd", "even");
                    foreach ($users as $i => $u) {
                        ?>
                        <tr class="<?php echo $class[($i % 2)]; ?> alumno">
                            <td><?php echo $u->apellidos; ?></td>
                            <td><?php echo $u->nombres; ?></td>                            
                            <td><?php echo $u->username; ?></td>
                            <td><?php echo $u->email; ?></td>
                            <td><?php echo $u->groups; ?></td>
                            <td class="estado" id="estado<?php echo $u->id; ?>"><?php  echo ($u->active) ? "Vigente" : "No vigente"; ?></td>
                            <td> <div id="icons">
                                    
                                    <a href="<?php echo base_url() . 'users/user_data/' . $u->id; ?>"><li class="ui-state-default ui-corner-all" title="Ver más" ><span class="ui-icon ui-icon-search" style="margin: 0 4px;"></span></li></a>

                                </div> </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width:90%; margin: auto;">
            <?php include('application/views/templates/pager.php'); ?>
        </div>
         <div id="footer">
  <?php echo $pages; ?>
  </div>
    <?php } ?> 


</div>

<div id="popup_vigente" title="Cambiar estado" >
    <span id="message"></span><br>
    <label for="dt_vigente">Fecha:</label>
    <input type="date" id="dt_vigente" /><br>
    <input type="button" id="cambiarBoton" value="Cambiar" style="cursor: pointer;"/>

</div>