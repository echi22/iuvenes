function  AlumnosView(){
    this.addPhone =  function(){
        var contenido = $("#telefonoData").clone();
        contenido.find("input").each(
            function(){
                $(this).val("");
        });
        contenido.find("#agregarTelefono").replaceWith(
                    '<li class="ui-state-default ui-corner-all" title="Eliminar" id="eliminarTelefono" onclick="alumnosView.deletePhone(this);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>');
        $("#telefonosContainer").append(contenido);
    };
    this.deletePhone = function(elem){
        $(elem).closest("#telefonoData").remove();
    };
    this.equalHeight = function(klass){
        var highestCol = Math.max($('#'+klass+"1").height(),$('#'+klass+"2").height());
        $('.'+klass).height(highestCol);
    };
    this.submitForm = function(){
        $("#form").submit();
    };
    this.deleteRow = function(elem,rowId){
        $(elem).closest("#"+rowId).remove();
    };
    this.addRelative = function(i){
        location.href= "update_parent/"+$('#persona_id'+i).val();
    };
    this.deleteRelated = function(elem,vinculo_id){
        if(confirm('¿Está seguro que desea eliminar ese vínculo?')){
            $.ajax({
                url : '../delete_related',
                type: "POST",
                data : 'vinculo_id='+vinculo_id,
                success : function(){
                        $(elem).closest('.familiar').remove();                   
                }           
            });
        }
    }
     this.addRow = function(rowId,rowContainerId){
        var contenido = $("#"+rowId).clone();
        contenido.find("input").each(
            function(){
                $(this).val("");
        });
        contenido.find('input, textarea, select').each(function(){
            var splitedName = $(this).attr('name').split("_");
            var nameForward = splitedName[0];
            var nameBack = splitedName.slice(2).join("_");
           $(this).attr('name', nameForward+'_'+$('#cant_'+rowId).val()+'_'+nameBack);
           $(this).val('');
        });
        $('#cant_'+rowId).val(parseInt($('#cant_'+rowId).val()) +1);
        contenido.find("#agregar_"+rowId).replaceWith(
                    '<li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow(this,\''+rowId+'\');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>');
        $("#"+rowContainerId).append(contenido);
    };
    this.setSelectedIndex = function(value,selectBoxId){
        var selectedIndex = 0;
        $("#"+selectBoxId).find("option").each(function(i,elem){
            if(elem.label == value){
                selectedIndex = i;

                return;
            }
        });
        $("#"+selectBoxId+" option:eq("+selectedIndex+")").attr('selected', 'selected');
    };
    this.setSelectedIndexByValue = function(value,selectBoxId){
        $("#"+selectBoxId).val(value);
    };
    
    this.show_editable = function(id){
        $(".edit"+id).show();
        $(".no_edit"+id).hide();
    };
    this.hide_editable = function(id){
        $(".no_edit"+id).show();
        $(".edit"+id).hide();
    };
    this.edit_related = function(vinculo_id){
        var parentesco = $("#parentesco"+vinculo_id).val();
        var autorizado = $("#autorizado"+vinculo_id).is(':checked');
        var av = this;
         $.ajax({
                url : '../edit_relative',
                type: "POST",
                data : 'vinculo_id='+vinculo_id+'&parentesco='+parentesco+'&autorizado='+autorizado,
                success : function(data){
                    data = jQuery.parseJSON(data);
                    $("#parentesco_no_edit"+vinculo_id).html(data[0]);
                    $("#autorizado_no_edit"+vinculo_id).html(data[1]);
                    av.hide_editable(vinculo_id);
                }           
            });
    }
}