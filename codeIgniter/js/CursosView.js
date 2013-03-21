function  CursosView(){
    this.alumnosSelected = new Array();
    this.listadoAlumnos = new Array();
    this.prestacionesSelected = new Array();
    this.listadoPrestaciones = new Array();
    this.selectMoveRows = function(SS1,SS2,selected,listado)
    {        
        var SelID='';
        var SelText='';
        // Move rows from SS1 to SS2 from bottom to top
        for (i=SS1.options.length - 1; i>=0; i--)
        {
            if (SS1.options[i].selected == true)
            {
                if(this.isInArray(SS1.options[i].value,listado)){
                    SelID=SS1.options[i].value;
                    SelText=SS1.options[i].text;
                    var newRow = new Option(SelText,SelID);
                    SS2.options[SS2.length]=newRow;
                    if(SS1.id == 'alumnos'){
                        selected.push(SS1.options[i].value);
                    }else{
                        selected.splice(selected.indexOf(SS1.options[i].value), 1);
                    }
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
    this.actualizarAlumnos = function(años_cursos,selectbox, multiple_selectbox,current_curso){
        $(multiple_selectbox).children().remove();
        var cv = this;
        $.ajax({
            url : '../get_alumnos_from_curso',
            type: "POST",
            data : {
                "id":$(selectbox).val(),
                'current_curso':current_curso,
                'anio_cursos':años_cursos
            },
            async: false,
            success : function(res) {
                cv.listadoAlumnos = new Array();
                res = jQuery.parseJSON(res);                            
                var newoptions = "";
                for(var i=0; i<res.length; i++) {
                    cv.listadoAlumnos[i] = res[i]['id'];                            
                    if((!cv.isInArray(res[i]['id'],cv.alumnosSelected)) && ($("#filtro_alumno").val() == "" || (res[i]['detalle'].toUpperCase().indexOf($("#filtro_alumno").val().toUpperCase()) !== -1)))
                        newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['detalle'] + "</option>";
                }
                $(multiple_selectbox).children().end().append(newoptions);
                            
            }           
        });
       
    };
    this.actualizarPrestaciones = function(prestaciones){
        $(prestaciones).children().remove();
        var cv = this;
        $.ajax({
            url : '../get_prestaciones',
            type: "POST",           
            async: false,
            success : function(res) {
                cv.listadoPrestaciones = new Array();
                res = jQuery.parseJSON(res);                            
                var newoptions = "";
                for(var i=0; i<res.length; i++) {
                    cv.listadoPrestaciones[i] = res[i]['id'];                            
                    if((!cv.isInArray(res[i]['id'],cv.prestacionesSelected)) && ($("#filtro_prestacion").val() == "" || (res[i]['detalle'].toUpperCase().indexOf($("#filtro_prestacion").val().toUpperCase()) !== -1)))
                        newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['detalle'] + "</option>";
                }
                $(prestaciones).children().end().append(newoptions);
                            
            }           
        });
       
    };
    this.isInArray = function(id_alumno,list){
        for(var i=0; i <list.length; i++) {                                
            if(list[i] == id_alumno)
                return true;
        }
        return false;
    };
    this.selectAllOptionsFromSelectbox = function(selectbox_id){
        $("#"+selectbox_id+">option").each(function(){
            this.selected = true;
        })
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
    this.deleteAlumno = function(elem,alumno_id,curso_id){
        if(confirm('¿Está seguro que desea eliminar al alumno de este curso?')){
            $.ajax({
                url : '../delete_alumno',
                type: "POST",
                data : {
                    'alumno_id':alumno_id,
                    'curso_id':curso_id
                },
                success : function(){
                    $(elem).closest('.alumno').remove();                   
                }           
            });
        }
    };

}