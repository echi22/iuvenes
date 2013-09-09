function  PlanEstudioView(){    
    this.addToList = function(elem,list,value){
        var text = $("#"+elem+" :selected").text();
        var li = "<li class='ui-state-default'>"+text+"<span  class='ui-icon ui-icon-close' onclick='planEstudioView.remove(this,"+value+","+list+")'></span></li>";
        $("#"+list).append(li);
    },
    this.addMateria = function(elem,list){
        var value = $("#"+elem+" :selected").val();
        if(this.materias.indexOf(value) === -1){
            this.addToList(elem,list,value);
            this.materias.push(value);
        }
    },
    this.addNivel = function(elem,list){
        var value = $("#"+elem+" :selected").val();
        if(this.niveles.indexOf(value) === -1){
            this.addToList(elem,list,value);
            this.niveles.push(value);
        }
    },
    this.remove = function(elem,value,list){
        if(list === "materias")
            this.materias.pop(value);
        else
            this.niveles.pop(value);
        $(elem).parent().remove();
    },
    this.addMateriasToAnioNivel= function(){
         $.ajax({
                url: 'add_materias_to_anio_nivel',
                type: "POST",
                data: {materias : this.materias,niveles : this.niveles},
                success: function() {
                    alert("Materias agregadas con éxito");
                }
            });
    },
    this.materias = new Array();
    this.niveles = new Array();
}

PlanEstudioView.prototype = new View;