function  PersonalesView(){    
   this.changeVigente = function(personal_id,elem){
        var vigente = ($("#estado"+personal_id).html() == "Vigente")? true : false;
        var pregunta = (vigente)? "¿Está seguro que desea marcar al personal como NO vigente?"  : "¿Está seguro que desea marcar al personal como  vigente?";        
        var vigenteString = (vigente)?"No vigente" : "Vigente";
        if(confirm(pregunta)){
            $.ajax({
                url : 'change_state',
                type: "POST",
                data : 'personal_id='+personal_id+'&vigente='+!vigente,
                success : function(){
                  $("#estado"+personal_id).html(vigenteString);
                }           
            });
        }
    };
    
    
}

PersonalesView.prototype = new View;