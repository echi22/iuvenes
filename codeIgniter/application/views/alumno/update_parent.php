<script type="text/javascript">
    function showDataOnParent(){
        window.opener.document.getElementById('persona').value = "<?php echo $persona->apellidos." ".$persona->nombres; ?>";
        window.opener.document.getElementById('persona_id').value= <?php echo $persona->id; ?>;
        window.close();
    }
    showDataOnParent();
</script>
