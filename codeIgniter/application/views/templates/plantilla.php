<!DOCTYPE html>
<html>
    <head>
        <?php include $head; ?>
       
    </head>
    <body onload="if(init != undefined)
                init();"> 
        <div class="contenedor">
            <?php include("cabecera.php"); ?>
        </div>  
        
        <div id="cuerpo">
            <div id="contenido_cuerpo">
                
                <?php include $contenido; ?>
                
            </div> 
        </div> 
    </body>
</html>
