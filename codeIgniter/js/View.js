function  View(){
    this.submitForm = function(id,enviar){
        return this.verificar_form(id, enviar);
    };
    this.verificar_form = function(id, enviar){
        var msg = 'Le falta llenar los siguientes campos:\n';
        var av = this;
        $('#'+id).find('.required').each(
            function(){            
                $(this).css("background-color", "white");
                if ($(this).is("input") && ($(this).val() == '')){
                    msg = av.verificar_input(msg, this);
                }else{
                    if($(this).is("select") && ($(this).val() == '-'))
                        msg = av.verificar_selectbox(msg,this);
                }                       
            });
        if(msg=='Le falta llenar los siguientes campos:\n'){
            if (enviar)
                $('#'+id).submit();
            return true;
        }else{
            alert(msg);
            return false;
        }
    };
    this.verificar_input = function(msg,elem){
        msg += ' - ';
        msg += $(elem).siblings('label').text().replace(':', '')+'\n';        
        $(elem).stop();
        $(elem).effect("highlight",{
            color : "#FF8484"
        },200000);
        return msg;
    };
    this.verificar_selectbox = function(msg,elem){    
        if ($(elem).val() == '-'){
            msg += ' - ';
            msg += $(elem).siblings('label').text().replace(':', '')+'\n';            
            $(elem).stop();
            $(elem).animate({
                backgroundColor: "#FF8484"
            }, 500);
            $(elem).effect("highlight",{
                color : "#FF8484"
            },200000);
        }        
        return msg;
    };
    this.deleteRow = function(elem,rowId){
        $(elem).closest("#"+rowId).remove();
    };
    this.setSelectedIndex = function(value,selectBoxId){
    
        $("#"+selectBoxId).find("option").each(function(i,elem){
            if(elem.label == value){
                elem.selected = true;             
            }
        });
        
    };
    this.setSelectedIndexByValue = function(value,selectBoxId){
        $("#"+selectBoxId).val(value);
    };
    
    this.show_editable = function(id){
        $(".edit_"+id).show();
        $(".no_edit_"+id).hide();
    };
    this.hide_editable = function(id){
        $(".no_edit_"+id).show();
        $(".edit_"+id).hide();
    };
    this.selectAllOptionsFromSelectbox = function(selectbox_id){
        $("#"+selectbox_id+">option").each(function(){
            this.selected = true;
        })
    };
    this.goBack = function(){
        window.history.back();
        return false;
    };
    this.loadStates = function(country_id,country_input_id){
        var v = this;
        var state_input_id = parseInt(country_input_id.split("_")[2]);

        $.ajax({
            url : '/iuvenes/controlador/get_states_from_country',
            type: "POST",
            data : 'country_id='+country_id,
            success : function(data){
                data = jQuery.parseJSON(data);
                v.setOptionsToSelectBox("dom_provincia_"+state_input_id, data, "ds_provincia");
            }           
        });  
    };
    this.loadLocalidades = function(state_id,state_input_id){
        var v = this;
        var localidad_input_id = parseInt(state_input_id.split("_")[2]);
        $.ajax({
            url : '/iuvenes/controlador/get_localidades_from_state',
            type: "POST",
            data : 'state_id='+state_id,
            success : function(data){
                data = jQuery.parseJSON(data);
                v.setOptionsToSelectBox("dom_localidad_"+localidad_input_id, data, "ds_localidad");
            }           
        });  
    };
    this.setOptionsToSelectBox = function(select_id,options,name){
        $("#"+select_id).find('option').remove();
        for(var i = 0; i < options.length; i++){
            $("#"+select_id).append('<option value="'+options[i].id+'">'+options[i][name]+'</option>')
        }
        $("#"+select_id).trigger('change');
    }
    
}