function  AlumnosView(){
    this.phones = [];
    this.phonesLength = 0;
    this.limpiarCamposPhone= function(){
         $("#cod_area").val("");
         $("#telefono").val("");
     };
    this.addPhone =  function(){
        var cod_area = $("#cod_area").val();
        var telefono = $("#telefono").val();
        var tipo = $("#tipo_telefono").val();
        if(!(isNaN(cod_area) || isNaN(telefono))){
            $("#telefonos_header").show();
            this.phonesLength++;
            this.phones[this.phones.length] = [cod_area,telefono,tipo];
            this.limpiarCamposPhone();
            $("#telefonos").append("<div class='row'><p id='telefono"+(this.phones.length-1)+"'><div class='div_input_chico'>("+cod_area+")</div><div class='div_input_chico'>"+telefono+"</div><div class='div_input_chico'>"+ $("#tipo_telefono :selected").text()+"</div><img src='../images/borrar.jpg' class='borrar' onclick='alumnosView.deletePhone("+(this.phones.length-1)+")'  ></p></div>");
        };
        this.equalHeight("equalColumn");
    };
    this.deletePhone = function(i){
        $("#telefono"+i).remove();
        this.phonesLength--;
        delete this.phones[i];
        if(this.phonesLength == 0){
            $("#telefonos_header").hide();
        }
        this.equalHeight("equalColumn");
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
       
    }
}


