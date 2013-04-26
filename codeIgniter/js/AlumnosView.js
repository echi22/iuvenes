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
    };
    
    this.deletePrestacion = function(elem,prestacion_id){
        if(confirm('¿Está seguro que desea eliminar esta prestación?')){
            $.ajax({
                url : '../delete_prestacion',
                type: "POST",
                data : 'prestacion_id='+prestacion_id,
                success : function(){
                    $(elem).closest('.prestacion').remove();                   
                }           
            });
        }
    };
    this.delete_licencia = function(elem,licencia_id){
        if(confirm('¿Está seguro que desea eliminar esta licencia?')){
            $.ajax({
                url : '../delete_licencia',
                type: "POST",
                data : 'licencia_id='+licencia_id,
                success : function(){
                    $(elem).closest('.licencia').remove();                   
                }           
            });
        }
    };
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
            var lastId = $(this).attr('id').split("_");
            $(this).attr('id', lastId[0]+'_'+lastId[1]+'_'+(parseInt(lastId[2] + 1)));
            $(this).val('');
        });
        $('#cant_'+rowId).val(parseInt($('#cant_'+rowId).val()) +1);
        contenido.find("#agregar_"+rowId).replaceWith(
            '<li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow(this,\''+rowId+'\');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>');
        $("#"+rowContainerId).append(contenido);
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
    };
    this.edit_prestacion = function(prestacion_id,persona_id){
        var cargo = $("#cargo_"+prestacion_id).val();
        var dt_inicio = $("#dt_inicio_"+prestacion_id).val();
        var dt_fin = $("#dt_fin_"+prestacion_id).val();
        var estado = $("#estado_"+prestacion_id).val();
        var carga_horaria = $("#carga_horaria_"+prestacion_id).val();
        var nu_secuencia = $("#nu_secuencia_"+prestacion_id).val();
        var tp_liq_sueldo = $("#tp_liq_sueldo_"+prestacion_id).val();
        var revista = $("#revista_"+prestacion_id).val();
        var asig_familiar = $("#asig_familiar_"+prestacion_id).val();
        var porc_asig_familiar = $("#porc_asig_familiar_"+prestacion_id).val();
        var av = this;
        $.ajax({
            url : '../edit_prestacion',
            type: "POST",
            data : 'prestacion_id='+prestacion_id+'&persona_id='+persona_id+'&cargo='+cargo+'&dt_inicio='+dt_inicio+'&dt_fin='+dt_fin+'&estado='+estado+'&qt_horas='+carga_horaria+'&nu_secuencia='+nu_secuencia+'&tp_liq_sueldo='+tp_liq_sueldo+'&revista='+revista+'&asig_familiar='+asig_familiar+'&porc_asig_familiar='+porc_asig_familiar,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#cargo_no_edit_"+prestacion_id).html(data['cargo']);
                $("#dt_inicio_no_edit_"+prestacion_id).html(data['dt_inicio']);
                $("#dt_fin_no_edit_"+prestacion_id).html(data['dt_fin']);
                $("#estado_no_edit_"+prestacion_id).html(data['estado']);
                $("#carga_horaria_no_edit_"+prestacion_id).html(data['qt_horas']);
                $("#nu_secuencia_no_edit_"+prestacion_id).html(data['nu_secuencia']);
                $("#tp_liq_sueldo_no_edit_"+prestacion_id).html(data['tp_liq_sueldo']);
                $("#revista_no_edit_"+prestacion_id).html(data['revista']);
                $("#asig_familiar_no_edit_"+prestacion_id).html(data['asig_familiar']);
                $("#porc_asig_familiar_no_edit_"+prestacion_id).html(data['porc_asig_familiar']);
                    
                av.hide_editable(prestacion_id);
            }           
        });
    };
    this.edit_licencia = function(licencia_id,persona_id){        
        var dt_inicio = $("#dt_inicio_"+licencia_id).val();
        var dt_fin = $("#dt_fin_"+licencia_id).val();
        var tipo_licencia = $("#tp_licencia_"+licencia_id).val();
        var av = this;
        $.ajax({
            url : '../edit_licencia',
            type: "POST",
            data : 'licencia_id='+licencia_id+'&persona_id='+persona_id+'&dt_inicio='+dt_inicio+'&dt_fin='+dt_fin+'&tipo_licencia='+tipo_licencia,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#dt_inicio_no_edit_"+licencia_id).html(data['dt_inicio']);
                $("#dt_fin_no_edit_"+licencia_id).html(data['dt_fin']);                   
                $("#tp_licencia_no_edit_"+licencia_id).html(data['tipo_licencia']);
                    
                av.hide_editable(licencia_id);
            }           
        });
    };
    this.createRelative = function(){
        var url = "../personas/create/true";
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="nombres" value="' + $('#nombres').val() + '" />' +
            '<input type="text" name="apellidos" value="' + $('#apellidos').val() + '" />' +
            '<input type="text" name="cd_identificacion" value="' + $('#cd_identificacion').val() + '" />' +
            '<input type="text" name="nu_identificacion" value="' + $('#numero_identificacion').val() + '" />' +
            '<input type="text" name="form_submited" value="0" />' +
            '</form>');
        $('body').append(form);
        $(form).submit();
    };
    
    this.alumno_exists = function(id_persona){
        var cd_identificaciones = $(".cd_identificacion");
        var nu_identificaciones = $(".nu_identificacion");
        var exists = false;
        for(var i = 0; i < cd_identificaciones.length; i++){
            $.ajax({
                url : '../alumno_exists/'+cd_identificaciones[i]+'/'+nu_identificaciones[i]+'/'+id_persona,
                type: "POST",                
                success : function(data){                                        
                    exists = data == 'true';
                }
            });
            if(exists)
                break;
        }
    }
   
    this.filtrarPrestaciones = function(){
        var num_prestacion = 0;
        for(var i = 0; i < parseInt($('#cant_prestaciones').val()); i++){
            var hide = false;
            num_prestacion = $('#prestacion'+i+'_id').val();
            $(".filtro_igual").each(function(index,elm){
                if((($(elm).val() !== $("#"+elm.id+"_"+num_prestacion).val()) || (hide)) && ($(elm).val() !== ""))
                    hide = true;
            })
            $(".filtro_menor").each(function(index,elm){
                if((($(elm).val() <= $("#"+elm.id+"_"+num_prestacion).val()) || (hide)) && (($("#"+elm.id+"_"+num_prestacion).val() !== '') && ($(elm).val() !== '')))
                    hide = true;
            })
            $(".filtro_mayor").each(function(index,elm){
                if(($(elm).val() >= $("#"+elm.id+"_"+num_prestacion).val()) || (hide))
                    hide = true;
            })
            if(hide)
                $("#prestacion"+i).hide();
            else
                $("#prestacion"+i).show();
        }
    }
    
}

AlumnosView.prototype = new View;