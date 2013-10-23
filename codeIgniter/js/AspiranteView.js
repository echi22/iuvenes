function  AspiranteView() {
    this.loadView = function(view,data){
        var av = this;
        $.ajax({
                url: view,
                data:data,
                type: "POST",               
                success: function(data) {
                    $("#"+view).html(data);
                    av.addMarkAsChangedHandler();
                }
            });
    },
    this.showAspirantesFromFase = function(fase,onlyFromFase){
        if(onlyFromFase == true)
            $("#fase"+fase+" .otra_fase").hide();
        else
            $("#fase"+fase+" .otra_fase").show();
    },
    this.addMarkAsChangedHandler = function(){
        $(".fase_container :input").change(function(){
            aspiranteView.markAsChanged(this);
        });
    },
    this.markAsChanged = function(obj){
        var row = $(obj).data("row")
        $("#"+row).attr('checked', true);
    }
   
}

AspiranteView.prototype = new View;