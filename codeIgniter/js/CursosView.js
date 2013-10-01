function  CursosView() {
    this.alumnosSelected = new Array();
    this.listadoAlumnos = new Array();
    this.prestacionesSelected = new Array();
    this.listadoPrestaciones = new Array();
    this.materias = new Object();
    this.ajaxRequests = new Array();
    var _self = this;
    this.selectMoveRows = function(SS1, SS2, selected, listado)
    {
        var SelID = '';
        var SelText = '';
        // Move rows from SS1 to SS2 from bottom to top
        for (i = SS1.options.length - 1; i >= 0; i--)
        {
            if (SS1.options[i].selected == true)
            {
                if (this.isInArray(SS1.options[i].value, listado)) {
                    SelID = SS1.options[i].value;
                    SelText = SS1.options[i].text;
                    var newRow = new Option(SelText, SelID);
                    SS2.options[SS2.length] = newRow;
                    if (SS1.id == 'alumnos') {
                        selected.push(SS1.options[i].value);
                    } else {
                        selected.splice(selected.indexOf(SS1.options[i].value), 1);
                    }
                }
                SS1.options[i] = null;
            }
        }
        this.selectSort(SS2);
    };
    this.selectSort = function(SelList)
    {
        var ID = '';
        var Text = '';
        for (x = 0; x < SelList.length - 1; x++)
        {
            for (y = x + 1; y < SelList.length; y++)
            {
                if (SelList[x].text > SelList[y].text)
                {
                    // Swap rows
                    ID = SelList[x].value;
                    Text = SelList[x].text;
                    SelList[x].value = SelList[y].value;
                    SelList[x].text = SelList[y].text;
                    SelList[y].value = ID;
                    SelList[y].text = Text;
                }
            }
        }
    };
    this.actualizarAlumnos = function(anios_cursos, selectbox, multiple_selectbox, current_curso) {
        $(multiple_selectbox).children().remove();
        var cv = this;
        if (typeof throttle2 !== "undefined"){
            clearTimeout(throttle2); // Clear the previous request
            xhr2.abort(); // Abort the last XHR request
        }
        throttle2 = setTimeout(function() {
            xhr2 =$.ajax({
                url: '../get_alumnos_from_curso',
                type: "POST",
                data: {
                    "id": $(selectbox).val(),
                    'current_curso': current_curso,
                    'anio_cursos': anios_cursos,
                    'filtro': $("#filtro_alumno").val()
                },
                success: function(res) {
                    cv.listadoAlumnos = new Array();
                    res = jQuery.parseJSON(res);
                    var newoptions = "";
                    for (var i = 0; i < res.length; i++) {
                        cv.listadoAlumnos[i] = res[i]['id'];
                        if ((!cv.isInArray(res[i]['id'], cv.alumnosSelected)))
                            newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['detalle'] + "</option>";
                    }
                    $(multiple_selectbox).children().end().append(newoptions);

                }
            });
        }, 250);
        

    };
    this.enableSearchByCursos = function(curso){
        $("#años_cursos").prop('disabled', false);
        $("#cursos").prop('disabled', false);
        this.actualizarAlumnos($('#años_cursos').val(),$('#cursos'),$('#alumnos'),curso);
        
    }
    this.getAlumnosFromCicloLectivo = function(multiple_selectbox, current_curso) {
        $("#años_cursos").prop('disabled', true);
        $("#cursos").prop('disabled', true);
        $(multiple_selectbox).children().remove();
        var cv = this;        
        if (typeof throttle2 !== "undefined"){
            clearTimeout(throttle2); // Clear the previous request
            xhr2.abort(); // Abort the last XHR request
        }
        throttle2 = setTimeout(function() {
            xhr2 =$.ajax({
                url: '../get_alumnos_from_ciclo_lectivo',
                type: "POST",
                data: {
                    'current_curso': current_curso,
                    'filtro': $("#filtro_alumno").val()
                },
                success: function(res) {
                    cv.listadoAlumnos = new Array();
                    res = jQuery.parseJSON(res);
                    var newoptions = "";
                    for (var i = 0; i < res.length; i++) {
                        cv.listadoAlumnos[i] = res[i]['id'];
                        if ((!cv.isInArray(res[i]['id'], cv.alumnosSelected)))
                            newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['detalle'] + "</option>";
                    }
                    $(multiple_selectbox).children().end().append(newoptions);

                }
            });
        }, 250);
        

    };
    this.actualizarPrestaciones = function(prestaciones,curso_id) {
        $(prestaciones).children().remove();
        var cv = this;
        if (typeof throttle !== "undefined"){
            clearTimeout(throttle); // Clear the previous request
            xhr.abort(); // Abort the last XHR request
        }
        throttle = setTimeout(function() {
            xhr = $.ajax({
                url: '../get_prestaciones',
                type: "POST",
                data:"curso_id="+curso_id+"&filtro="+$("#filtro_prestacion").val(),
                success: function(res) {
                    cv.listadoPrestaciones = new Array();
                    res = jQuery.parseJSON(res);
                    var newoptions = "";
                    for (var i = 0; i < res.length; i++) {
                        cv.listadoPrestaciones[i] = res[i]['id'];
                        if ((!cv.isInArray(res[i]['id'], cv.prestacionesSelected)) && ($("#filtro_prestacion").val() == "" || (res[i]['detalle'].toUpperCase().indexOf($("#filtro_prestacion").val().toUpperCase()) !== -1)))
                            newoptions += "<option value=\"" + res[i]['id'] + "\">" + res[i]['detalle'] + "</option>";
                    }
                    $(prestaciones).children().end().append(newoptions);

                }
            });
        }, 250);

    };

    this.isInArray = function(id_alumno, list) {
        for (var i = 0; i < list.length; i++) {
            if (list[i] == id_alumno)
                return true;
        }
        return false;
    };


    this.deleteAlumno = function(elem, alumno_id, curso_id) {
        if (confirm('¿Está seguro que desea eliminar al alumno de este curso?')) {
            $.ajax({
                url: '../delete_alumno',
                type: "POST",
                data: {
                    'alumno_id': alumno_id,
                    'curso_id': curso_id
                },
                success: function() {
                    $(elem).closest('.alumno').remove();
                }
            });
        }
    };
    this.deletePrestacion = function(elem, alumno_id, curso_id) {
        var cv = this;
        if (confirm('¿Está seguro que desea eliminar la prestación de este curso?')) {
            $.ajax({
                url: '../delete_prestacion',
                type: "POST",
                data: {
                    'prestacion_id': alumno_id,
                    'curso_id': curso_id
                },
                success: function() {
                    $(elem).closest('.prestacion').remove();
                    cv.actualizarPrestaciones($("#prestaciones"));
                }
            });
        }
    };

    this.saveHorarios = function(curso_id) {
        $.ajax({
            url: '../save_horarios',
            type: "POST",
            data: {
                'table': $("#table").html(),
                'curso_id': curso_id
            },
            success: function() {
                alert("Horarios guardados exitosamente");
            }
        });
    };
    this.getMateriasFromCurso = function(curso_id) {
        $.ajax({
            url: '../get_materias_from_curso',
            type: "POST",
            data: {
                'curso_id': curso_id
            },
            success: function(data) {
                data = jQuery.parseJSON(res);

            }
        });
    };

    this.submitMaterias = function(curso_id) {
        var data = new Object();
        data.materias = new Array();
        data.docentes = new Array();
        data.suplentes = new Array();
        for (var i = 0; i < $(".materias").length; i++) {
            data.materias.push($(".materias")[i].value);
            data.docentes.push($(".docentes")[i].value);
            data.suplentes.push($(".suplentes")[i].value);
        }
        data = JSON.stringify(data);
        $.ajax({
            url: '../save_materias_docentes',
            type: "POST",
            data: {
                'curso_id': curso_id,
                'data': data
            },
            success: function(res) {
                alert("Docentes guardados correctamente");
                res = jQuery.parseJSON(res);
                _self.updateShowingSuplente(res);
            }
        });
    };
    this.updateShowingSuplente = function(res){
        for (var i = 0; i < $(".docentes").length; i++) {            
            if(res[$(".docentes")[i].id]){
                $("#"+$('.docentes')[i].id+"_suplente").show();
            }
        }
    }
}
CursosView.prototype = new View;