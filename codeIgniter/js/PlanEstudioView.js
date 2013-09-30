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
            data: {
                materias : this.materias,
                niveles : this.niveles
            },
            success: function() {
                alert("Materias agregadas con éxito");
            }
        });
    },
    this.edit_orientation = function(id){        
        var orientation = $("#orientation_"+id).val();       
        $.ajax({
            url : 'edit_orientation',
            type: "POST",
            data : 'id='+id+'&orientation='+orientation,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#orientation_no_edit_"+id).html(data['ds_orientacion']);               
                    
                _self.hide_editable(id);
            }           
        });
    },
    this.edit_materium = function(id){        
        var materium = $("#materium_"+id).val();
        var color = $("#color_"+id).val();
        $.ajax({
            url : 'edit_materium',
            type: "POST",
            data : 'id='+id+'&nombre='+materium+'&color='+color,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#materium_no_edit_"+id).html(data['nombre']);  
                $("#color_no_edit_"+id).val(data['color']);              
                    
                _self.hide_editable(id);
            }           
        });
    },
    
    this.edit_ley_educacion = function(id){        
        var ley = $("#ds_ley_educacion_"+id).val();
        var dt_ini = $("#dt_ini_"+id).val();
        var dt_fin = $("#dt_fin_"+id).val();
        var in_vigente = $("#vigente_"+id).is(":checked");
        $.ajax({
            url : 'edit_ley_educacion',
            type: "POST",
            data : 'id='+id+'&ds_ley='+ley+'&dt_ini_vig='+dt_ini+'&dt_fin_vig='+dt_fin+'&in_vigente='+in_vigente,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#ds_ley_educacion_no_edit_"+id).html(data['ds_ley']);  
                $("#dt_ini_no_edit_"+id).html(data['dt_ini_vig']);              
                $("#dt_fin_no_edit_"+id).html(data['dt_fin_vig']);              
                $("#vigente_no_edit_"+id).html((data['in_vigente'] == 'true' ? "Vigente" : "No vigente"));              
                _self.hide_editable(id);
            }           
        });
        
    },
    this.edit_nivel_educativo = function(id){        
        var nivel = $("#nivel_educativo_"+id).val();
        var ley = $("#ley_educacion_"+id).val();
        var dt_ini = $("#dt_ini_"+id).val();
        var dt_fin = $("#dt_fin_"+id).val();
        var in_vigente = $("#vigente_"+id).is(":checked");
        $.ajax({
            url : 'edit_nivel_educativo',
            type: "POST",
            data : 'id='+id+'&ley='+ley+'&dt_ini_vig='+dt_ini+'&dt_fin_fic='+dt_fin+'&in_vigente='+in_vigente+'&nivel='+nivel,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#nivel_educativo_no_edit_"+id).html(data['ds_nivel']);  
                $("#dt_ini_no_edit_"+id).html(data['dt_ini_vig']);              
                $("#dt_fin_no_edit_"+id).html(data['dt_fin_fic']);              
                $("#vigente_no_edit_"+id).html((data['in_vigente'] == 'true' ? "Vigente" : "No vigente"));          
                $("#ley_educacion_no_edit_"+id).html(data['ley_educacion'].ds_ley);
                _self.hide_editable(id);
            }           
        });
        
    },
    this.edit_anio_nivel = function(id){        
        var anio = $("#anio_"+id).val();
        var nivel = $("#nivel_educativo_"+id).val();
        var orientacion = $("#orientation_"+id).val();        
        $.ajax({
            url : 'edit_anio_nivel',
            type: "POST",
            data : 'id='+id+'&anio='+anio+'&nivel='+nivel+'&orientacion='+orientacion,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#anio_no_edit_"+id).html(data['ds_anio']);  
                $("#nivel_educativo_no_edit_"+id).html(data['nivel_educativo'].ds_nivel);
                $("#orientation_no_edit_"+id).html(data['orientation'].ds_orientacion);
                _self.hide_editable(id);
            }           
        });
        
    },
    this.check_inputs = function(id,enviar){
        var result;
        $.ajax({
            url : 'check_available_color',
            type: "POST",
            data : 'color='+$("#color").val(),
            success : function(data){
                result = jQuery.parseJSON(data); 
                if(result)
                    _self.submitForm(id, enviar);
                else
                    alert("El color seleccionado ya está en uso. Por favor seleccione otro");
            }           
        });
        
    },
    this.delete_element = function(type,id,elem){
        if(confirm("¿Está seguro que desea eliminar este elemento?")){                    
            $.ajax({
                url : 'delete_'+type,
                type: "POST",
                data : 'id='+id,
                success : function(data){
                    data = jQuery.parseJSON(data);
                    _self.deleteRow(elem, "row_"+type+"_"+id);
                    alert("Elemento borrado con éxito");
                }           
            });
        }else{
            return false;
        }        
    }
    
    this.materias = new Array();
    this.niveles = new Array();
    var _self = this;
    
}

PlanEstudioView.prototype = new View;