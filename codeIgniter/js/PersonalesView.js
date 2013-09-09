function  PersonalesView() {
    this.confirmChangeVigente = function(personal_id, elem) {
        var vigente = ($("#estado" + personal_id).html() == "Vigente") ? true : false;
        var pregunta = (vigente) ? "¿Está seguro que desea marcar al personal como NO vigente?" : "¿Está seguro que desea marcar al personal como  vigente?";
        $("#message").text(pregunta);
        $("#popup_vigente").dialog("open");
        var pv = this;
        $("#cambiarBoton").click(function() {
            pv.changeVigente(personal_id, elem, vigente)
        });

    };
    this.changeVigente = function(personal_id, elem, vigente) {
        var vigenteString = (vigente) ? "No vigente" : "Vigente";
        var klass = (vigente) ? "ui-icon-check" : "ui-icon-trash";
        $.ajax({
            url: 'change_state',
            type: "POST",
            data: 'personal_id=' + personal_id + '&vigente=' + !vigente+ '&fecha=' + $("#dt_vigente").val(),
            success: function() {
                $("#popup_vigente").dialog("close");
                $("#estado" + personal_id).html(vigenteString);
                $(elem).children("span").removeClass();
                $(elem).children("span").addClass("ui-icon "+klass);
                alert("El estado del personal ha sido modificado");
            }
        });
    }
     this.deletePrestacion = function(elem, prestacion_id) {
        if (confirm('¿Está seguro que desea eliminar esta prestación?')) {
            $.ajax({
                url: '../delete_prestacion',
                type: "POST",
                data: 'prestacion_id=' + prestacion_id,
                success: function() {
                    $(elem).closest('.prestacion').remove();
                }
            });
        }
    };
    this.delete_licencia = function(elem, licencia_id) {
        if (confirm('¿Está seguro que desea eliminar esta licencia?')) {
            $.ajax({
                url: '../delete_licencia',
                type: "POST",
                data: 'licencia_id=' + licencia_id,
                success: function() {
                    $(elem).closest('.licencia').remove();
                }
            });
        }
    };
    this.delete_adelanto = function(elem, adelanto_id) {
        if (confirm('¿Está seguro que desea eliminar este adelanto?')) {
            $.ajax({
                url: '../delete_adelanto',
                type: "POST",
                data: 'adelanto_id=' + adelanto_id,
                success: function() {
                    $(elem).closest('.adelanto').remove();
                }
            });
        }
    };    
    this.edit_prestacion = function(prestacion_id, persona_id) {
        var cargo = $("#cargo_" + prestacion_id).val();
        var dt_inicio = $("#dt_inicio_" + prestacion_id).val();
        var dt_fin = $("#dt_fin_" + prestacion_id).val();
        var estado = $("#estado_" + prestacion_id).val();
        var carga_horaria = $("#carga_horaria_" + prestacion_id).val();
        var nu_secuencia = $("#nu_secuencia_" + prestacion_id).val();
        var tp_liq_sueldo = $("#tp_liq_sueldo_" + prestacion_id).val();
        var revista = $("#revista_" + prestacion_id).val();
        var asig_familiar = $("#asig_familiar_" + prestacion_id).val();
        var porc_asig_familiar = $("#porc_asig_familiar_" + prestacion_id).val();
        var av = this;
        $.ajax({
            url: '../edit_prestacion',
            type: "POST",
            data: 'prestacion_id=' + prestacion_id + '&persona_id=' + persona_id + '&cargo=' + cargo + '&dt_inicio=' + dt_inicio + '&dt_fin=' + dt_fin + '&estado=' + estado + '&qt_horas=' + carga_horaria + '&nu_secuencia=' + nu_secuencia + '&tp_liq_sueldo=' + tp_liq_sueldo + '&revista=' + revista + '&asig_familiar=' + asig_familiar + '&porc_asig_familiar=' + porc_asig_familiar,
            success: function(data) {
                data = jQuery.parseJSON(data);
                $("#cargo_no_edit_" + prestacion_id).html(data['cargo']);
                $("#dt_inicio_no_edit_" + prestacion_id).html(data['dt_inicio']);
                $("#dt_fin_no_edit_" + prestacion_id).html(data['dt_fin']);
                $("#estado_no_edit_" + prestacion_id).html(data['estado']);
                $("#carga_horaria_no_edit_" + prestacion_id).html(data['qt_horas']);
                $("#nu_secuencia_no_edit_" + prestacion_id).html(data['nu_secuencia']);
                $("#tp_liq_sueldo_no_edit_" + prestacion_id).html(data['tp_liq_sueldo']);
                $("#revista_no_edit_" + prestacion_id).html(data['revista']);
                $("#asig_familiar_no_edit_" + prestacion_id).html(data['asig_familiar']);
                $("#porc_asig_familiar_no_edit_" + prestacion_id).html(data['porc_asig_familiar']);

                av.hide_editable(prestacion_id);
            }
        });
    };
    this.edit_adelanto = function(adelanto_id, persona_id) {
        var dt_adelanto = $("#dt_adelanto_" + adelanto_id).val();
        var monto = $("#monto_" + adelanto_id).val();        
        var dt_cobro = $("#dt_cobro_" + adelanto_id).val();
        var tipo_adelanto = $("#tipo_adelanto_" + adelanto_id).val();
        var estado_adelanto = $("#estado_adelanto_" + adelanto_id).val();
        var av = this;
        $.ajax({
            url: '../edit_adelanto',
            type: "POST",
            data: 'adelanto_id=' + adelanto_id + '&persona_id=' + persona_id + '&dt_adelanto=' + dt_adelanto + '&dt_cobro=' + dt_cobro + '&tipo_adelanto=' + tipo_adelanto+ '&estado_adelanto=' + estado_adelanto+ '&monto=' + monto,
            success: function(data) {
                data = jQuery.parseJSON(data);
                $("#dt_adelanto_no_edit_" + adelanto_id).html(data['dt_adelanto']);
                $("#monto_no_edit_" + adelanto_id).html(data['monto']);
                $("#tipo_adelanto_no_edit_" + adelanto_id).html(data['tipo_adelanto']);
                $("#dt_cobro_no_edit_" + adelanto_id).html(data['dt_cobro']);
                $("#estado_adelanto_no_edit_" + adelanto_id).html(data['estado_adelanto']);
                av.hide_editable(adelanto_id);
            }
        });
    };
    this.edit_licencia = function(licencia_id, persona_id) {
        var dt_inicio = $("#dt_inicio_" + licencia_id).val();
        var dt_fin = $("#dt_fin_" + licencia_id).val();
        var tipo_licencia = $("#tp_licencia_" + licencia_id).val();
        var av = this;
        $.ajax({
            url: '../edit_licencia',
            type: "POST",
            data: 'licencia_id=' + licencia_id + '&persona_id=' + persona_id + '&dt_inicio=' + dt_inicio + '&dt_fin=' + dt_fin + '&tipo_licencia=' + tipo_licencia,
            success: function(data) {
                data = jQuery.parseJSON(data);
                $("#dt_inicio_no_edit_" + licencia_id).html(data['dt_inicio']);
                $("#dt_fin_no_edit_" + licencia_id).html(data['dt_fin']);
                $("#tp_licencia_no_edit_" + licencia_id).html(data['tipo_licencia']);

                av.hide_editable(licencia_id);
            }
        });
    };
    this.filtrarPrestaciones = function() {
        var num_prestacion = 0;
        for (var i = 0; i < parseInt($('#cant_prestaciones').val()); i++) {
            var hide = false;
            num_prestacion = $('#prestacion' + i + '_id').val();
            $(".filtro_igual").each(function(index, elm) {
                if ((($(elm).val() !== $("#" + elm.id + "_" + num_prestacion).val()) || (hide)) && ($(elm).val() !== ""))
                    hide = true;
            })
            $(".filtro_menor").each(function(index, elm) {
                if ((($(elm).val() <= $("#" + elm.id + "_" + num_prestacion).val()) || (hide)) && (($("#" + elm.id + "_" + num_prestacion).val() !== '') && ($(elm).val() !== '')))
                    hide = true;
            })
            $(".filtro_mayor").each(function(index, elm) {
                if (($(elm).val() >= $("#" + elm.id + "_" + num_prestacion).val()) || (hide))
                    hide = true;
            })
            if (hide)
                $("#prestacion" + i).hide();
            else
                $("#prestacion" + i).show();
        }
    };
    this.addDays= function(firstDate,days,secondDate){
        var date = new Date($("#"+firstDate).val().split("-"));        
        date.setDate(parseInt(date.getDate()) + parseInt(days));
        $("#"+secondDate).val(date.getFullYear()+"-"+("0" + (date.getMonth() + 1)).slice(-2)+"-"+("0" + date.getDate()).slice(-2));
    };
    this.getDiffDays = function(firstDate,secondDate,daysInput){
        var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
        var firstDate = new Date($("#"+firstDate).val().split("-"));
        var secondDate = new Date($("#"+secondDate).val().split("-"));
        var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
        $("#"+daysInput).val(diffDays);
    };
    
}

PersonalesView.prototype = new View;