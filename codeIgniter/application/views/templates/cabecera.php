<?php
session_start(); ?>
<div id="cabecera">
    <div class="logo"><img src="<?php echo $img_path; ?>logo.png"><img src="<?php echo $img_path; ?>cabecera.png"><span class="working_on">Colegio <?php echo $_SESSION['establecimiento']; ?></span></div>
    <div> <?php include("menu.php"); ?></div>
    <div style="display:none;"><a href="http://apycom.com/">jQuery Menu by Apycom</a></div>
</div>
