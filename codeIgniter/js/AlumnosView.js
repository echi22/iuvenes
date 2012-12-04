function  AlumnosView(){
    this.phones = [];
    this.phonesLength = 0;
    this.limpiarCamposPhone= function(){
         $("#cod_area").val("");
         $("#telefono").val("");
     };
    this.addPhone =  function(){
        var contenido = $("#telefonoData").clone();
        contenido.find("input").each(
            function(){
                $(this).val("");
        });
        contenido.find("#agregarTelefono").replaceWith(
                    '<li class="ui-state-default ui-corner-all" title="Eliminar" id="eliminarTelefono" onclick="alumnosView.deletePhone(this);"><span class="ui-icon ui-icon-minus" style="margin: 0 4px;"></span></li>')
        $("#telefonosContainer").append(contenido);        
    };
    this.deletePhone = function(elem){
        $(elem).closest("#telefonoData").remove();
    }
    this.equalHeight = function(klass){
        var highestCol = Math.max($('#'+klass+"1").height(),$('#'+klass+"2").height());
        $('.'+klass).height(highestCol);
    }
    this.sendPhones = function(){
        var cod_area = new Array();
        var telefono = new Array();
        var tipo_tel = new Array();
        for(var i = 0; i < this.phones.length; i++){
            if(this.phones[i]){
                cod_area.push(this.phones[i][0]);
                telefono.push(this.phones[i][1]);
                tipo_tel.push(this.phones[i][2]);
            }
        }
        
        $("#cod_area_hidden").val(cod_area);
        $("#telefono_hidden").val(telefono);
        $("#tipo_tel_hidden").val(tipo_tel);
        $("#form").submit();
    },
    this.addRelative = function(i){
        location.href= "update_parent/"+$('#persona_id'+i).val();
       
    },
    this.addDomicilio = function(){
        var contenido = $("#domicilio").clone();
        contenido.find("input").each(
            function(){
                $(this).val("");
        });
        $("#domicilios").append(contenido);
    }
}


