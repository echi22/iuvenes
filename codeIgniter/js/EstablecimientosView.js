function  EstablecimientosView(){    
    this.delete_establecimiento = function(elem,establecimiento_id){
        if(confirm('¿Está seguro que desea eliminar este establecimiento?')){
            $.ajax({
                url : 'delete_establecimiento',
                type: "POST",
                data : 'establecimiento_id='+establecimiento_id,
                success : function(){
                    $(elem).closest('.establecimiento').remove();                   
                }           
            });
        }
    };
    this.work_here = function(elem,establecimiento_id){        
        if(confirm('¿Está seguro que desea trabajar en este establecimiento?')){
            $.ajax({
                url : 'work_here',
                type: "POST",
                data : 'establecimiento_id='+establecimiento_id,
                success : function(data){
                    $(".establecimiento").removeClass("top").removeClass("row2").removeClass("bottom");
                    $(elem).closest('.establecimiento').addClass("top").addClass("row2").addClass("bottom");               
                    $(".working_on").html("Colegio "+data)
                }           
            });
        }
    };
    this.edit_establecimiento = function(establecimiento_id){        
        var ds_establecimiento = $("#ds_establecimiento_"+establecimiento_id).val();        
        var ev = this;
        $.ajax({
            url : 'edit_establecimiento',
            type: "POST",
            data : 'establecimiento_id='+establecimiento_id+'&ds_establecimiento='+ds_establecimiento,
            success : function(data){
                data = jQuery.parseJSON(data);
                $("#ds_establecimiento_no_edit_"+establecimiento_id).html(data['ds_establecimiento']);               
                    
                ev.hide_editable(establecimiento_id);
            }           
        });
    };
    
    
}

EstablecimientosView.prototype = new View;