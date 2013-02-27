function  CursosView(){

    this.selectMoveRows = function(SS1,SS2)
    {
        var SelID='';
        var SelText='';
        // Move rows from SS1 to SS2 from bottom to top
        for (i=SS1.options.length - 1; i>=0; i--)
        {
            if (SS1.options[i].selected == true)
            {
               if(this.alumnoIsInList(SS1.options[i].value,this.listadoAlumnos)){
                    SelID=SS1.options[i].value;
                    SelText=SS1.options[i].text;
                    var newRow = new Option(SelText,SelID);
                    SS2.options[SS2.length]=newRow;
                    
               }
               SS1.options[i]=null;
            }
        }
        this.selectSort(SS2);
    };
    this.selectSort = function(SelList)
    {
        var ID='';
        var Text='';
        for (x=0; x < SelList.length - 1; x++)
        {
            for (y=x + 1; y < SelList.length; y++)
            {
                if (SelList[x].text > SelList[y].text)
                {
                    // Swap rows
                    ID=SelList[x].value;
                    Text=SelList[x].text;
                    SelList[x].value=SelList[y].value;
                    SelList[x].text=SelList[y].text;
                    SelList[y].value=ID;
                    SelList[y].text=Text;
                }
            }
        }
    };
    this.actualizarAlumnos = function(selectbox, multiple_selectbox){
        $(multiple_selectbox).children().remove();
        var cv = this;
        $.ajax({
                url : 'get_alumnos_from_curso',
                type: "POST",
                data : {"id":$(selectbox).val()},
                success : function(res) {
                            res = jQuery.parseJSON(res);
                            var newoptions = "";
                            for(var i=0; i<res.length; i++) {                                
                                newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['detalle'] + "</option>";
                            }
                            $(multiple_selectbox).children().end().append(newoptions);
                            cv.listadoAlumnos = res;
                        }           
            });
        
    };
    this.alumnoIsInList = function(id_alumno,list){
        for(var i=0; i <list.length; i++) {                                
            if(list[i]['id'] == id_alumno)
                return true;
        }
        return false;
    }
}