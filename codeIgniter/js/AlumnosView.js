function  AlumnosView() {
    this.existingPersons = ["a"];
    var _self = this;
    this.addPhone = function() {
        var contenido = $("#telefonoData").clone();
        contenido.find("input").each(
                function() {
                    $(this).val("");
                });
        contenido.find("#agregarTelefono").replaceWith(
                '<li class="ui-state-default ui-corner-all" title="Eliminar" id="eliminarTelefono" onclick="alumnosView.deletePhone(this);"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>');
        $("#telefonosContainer").append(contenido);
    };
    this.deletePhone = function(elem) {
        $(elem).closest("#telefonoData").remove();
    };
    this.equalHeight = function(klass) {
        var highestCol = Math.max($('#' + klass + "1").height(), $('#' + klass + "2").height());
        $('.' + klass).height(highestCol);
    };

    this.addRelative = function(i) {
        location.href = "update_parent/" + $('#persona_id' + i).val();
    };
    this.deleteRelated = function(elem, vinculo_id) {
        if (confirm('¿Está seguro que desea eliminar ese vínculo?')) {
            $.ajax({
                url: '../delete_related',
                type: "POST",
                data: 'vinculo_id=' + vinculo_id,
                success: function() {
                    $(elem).closest('.familiar').remove();
                }
            });
        }
    };


    this.addRow = function(rowId, rowContainerId) {
        var contenido = $("#" + rowId).clone();
        contenido.find("input").each(
                function() {
                    $(this).val("");
                });
        contenido.find('input, textarea, select').each(function() {
            var splitedName = $(this).attr('name').split("_");
            var nameForward = splitedName[0];
            var nameBack = splitedName.slice(2).join("_");
            $(this).attr('name', nameForward + '_' + $('#cant_' + rowId).val() + '_' + nameBack);
            var lastId = $(this).attr('id').split("_");
            $(this).attr('id', lastId[0] + '_' + lastId[1] + '_' + (parseInt(lastId[2] + 1)));
            $(this).val('');
        });
        $('#cant_' + rowId).val(parseInt($('#cant_' + rowId).val()) + 1);
        contenido.find("#agregar_" + rowId).replaceWith(
                '<li class="ui-state-default ui-corner-all" title="Eliminar"  onclick="alumnosView.deleteRow(this,\'' + rowId + '\');"><span class="ui-icon ui-icon-close" style="margin: 0 4px;"></span></li>');
        $("#" + rowContainerId).append(contenido);
    };


    this.edit_related = function(vinculo_id) {
        var parentesco = $("#parentesco" + vinculo_id).val();
        var autorizado = $("#autorizado" + vinculo_id).is(':checked');
        var av = this;
        $.ajax({
            url: '../edit_relative',
            type: "POST",
            data: 'vinculo_id=' + vinculo_id + '&parentesco=' + parentesco + '&autorizado=' + autorizado,
            success: function(data) {
                data = jQuery.parseJSON(data);
                $("#parentesco_no_edit" + vinculo_id).html(data[0]);
                $("#autorizado_no_edit" + vinculo_id).html(data[1]);
                av.hide_editable(vinculo_id);
            }
        });
    };

    this.createRelative = function() {
        var url = "../personas/create/true";
        var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="nombres" value="' + $('#nombres').val() + '" />' +
                '<input type="text" name="apellidos" value="' + $('#apellidos').val() + '" />' +
                '<input type="text" name="cd_identificacion" value="' + $('#cd_identificacion').val() + '" />' +
                '<input type="text" name="nu_identificacion" value="' + $('#numero_identificacion').val() + '" />' +
                '<input type="text" name="form_submited" value="0" />' +
                '</form>');
        $('body').append(form);
        $(form).submit();
    };

    this.alumno_exists = function(id_persona) {
        var cd_identificaciones = $(".cd_identificacion");
        var nu_identificaciones = $(".nu_identificacion");
        var exists = false;
        for (var i = 0; i < cd_identificaciones.length; i++) {
            $.ajax({
                url: '../alumno_exists/' + cd_identificaciones[i] + '/' + nu_identificaciones[i] + '/' + id_persona,
                type: "POST",
                success: function(data) {
                    exists = data == 'true';
                }
            });
            if (exists)
                break;
        }
    };



    this.confirmChangeVigente = function(alumno_id, elem) {
        var vigente = ($("#estado" + alumno_id).html() == "Vigente") ? true : false;
        var pregunta = (vigente) ? "¿Está seguro que desea marcar al alumno como NO vigente?" : "¿Está seguro que desea marcar al alumno como  vigente?";
        $("#message").text(pregunta);
        $("#popup_vigente").dialog("open");
        var av = this;
        $("#cambiarBoton").click(function() {
            av.changeVigente(alumno_id, elem, vigente)
        });

    };
    this.changeVigente = function(alumno_id, elem, vigente) {
        var vigenteString = (vigente) ? "No vigente" : "Vigente";
        var klass = (vigente) ? "ui-icon-check" : "ui-icon-trash";
        $.ajax({
            url: 'change_state',
            type: "POST",
            data: 'alumno_id=' + alumno_id + '&vigente=' + !vigente + '&fecha=' + $("#dt_vigente").val(),
            success: function() {
                $("#popup_vigente").dialog("close");
                $("#estado" + alumno_id).html(vigenteString);
                $(elem).children("span").removeClass();
                $(elem).children("span").addClass("ui-icon " + klass);
                alert("El estado del alumno ha sido modificado");
            }
        });

    }
    this.getExistingPersons = function() {
        $.ajax({
            url: 'get_existing_persons',
            type: "POST",
            data: 'nombres=' + $("#nombres").val() + '&apellidos=' + $("#apellidos").val() + '&cd_identificacion=' + $("#cd_identificacion").val() + '&ds_identificacion=' + $("#ds_identificacion").val(),
            success: function(data) {
                data = jQuery.parseJSON(data);
                $("#persona_existente").autocomplete({
                    source: data
                }).data("ui-autocomplete")._renderItem = function(ul, item) {
                    return $("<li>")
                            .append("<a>" + item.apellidos + " "+ item.nombres + "</a>")
                            .appendTo(ul);
                };
                ;
            }
        });
    }
}

AlumnosView.prototype = new View;