$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $('#radicados').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }],
        responsive: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        rowReorder: false,
        order: [[0, "desc"]],
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            row: "Registro",
            export: "Exportar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            select: {
                row: "registro",
                selected: "seleccionado"
            }
        }
    });
    $('#reporte').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }],
        responsive: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        rowReorder: false,
        order: [[0, "desc"]],
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            row: "Registro",
            export: "Exportar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            select: {
                row: "registro",
                selected: "seleccionado"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    { extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'LEGAL' },
                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '10pt');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
            }]
    });
});

$(function () {

    $('#form-crear_radicado').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $('#form-actualizar_radicado').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

function obtener_datos_radicado(id) {
    var Radicado = $("#radicado" + id).val();
    var Asunto = $("#asunto" + id).val();
    var Destinatario = $("#destinatario" + id).val();
    var NombreCiudadano = $("#nombre_ciudadano" + id).val();
    var TipoDocumento = $("#tipo_documento" + id).val();
    var Identificacion = $("#identificacion" + id).val();
    var Direccion = $("#direccion" + id).val();
    var Ciudad = $("#ciudad" + id).val();
    var IdPersona = $("#id_persona" + id).val();
    var Anexos = $("#anexos" + id).val();
    var Estado = $("#estado" + id).val();
    var Comentario = $("#comentario" + id).val();
    var RadicadoSalida = $("#radicado_salida" + id).val();

    $("#idRadicado_upd").val(id);
    $("#upd_radicado").val(Radicado);
    $("#upd_asunto").val(Asunto);
    $("#upd_destinatario").val(Destinatario);
    $("#upd_nombre_ciudadano").val(NombreCiudadano);
    $("#upd_tipo_documento").val(TipoDocumento);
    $("#upd_identificacion").val(Identificacion);
    $("#upd_direccion").val(Direccion);
    $("#upd_ciudad").val(Ciudad);
    $("#upd_id_persona").val(IdPersona);
    $("#upd_comentario").val(Comentario);
    $("#upd_radicado_salida").val(RadicadoSalida);

    $("#VerAnexos").click(function(){
        document.getElementById('anexosRadicado').innerHTML = Anexos;
    });

    var x = document.getElementById("mod_radicado_salida");

    if(Estado == '2'){
        x.style.display = "block";
        document.getElementById("upd_destinatario").readOnly = true;
        document.getElementById("upd_nombre_ciudadano").readOnly = true;
        $('#upd_tipo_documento').prop('disabled', 'disabled');
        document.getElementById("upd_identificacion").readOnly = true;
        document.getElementById("upd_direccion").readOnly = true;
        document.getElementById("upd_ciudad").readOnly = true;
        document.getElementById("upd_comentario").readOnly = true;
        document.getElementById("upd_radicado_salida").readOnly = true;
        document.getElementById("upd_comentario").required = true;
        document.getElementById("upd_radicado_salida").required = true;
    }else{
        x.style.display = "none";
        document.getElementById("upd_comentario").required = false;
        document.getElementById("upd_radicado_salida").required = false;
        document.getElementById("upd_comentario").readOnly = true;
        document.getElementById("upd_radicado_salida").readOnly = true;
    }

}

function finalizar_radicado(id) {
    var Radicado = $("#radicado" + id).val();
    var Asunto = $("#asunto" + id).val();
    var Destinatario = $("#destinatario" + id).val();
    var NombreCiudadano = $("#nombre_ciudadano" + id).val();
    var TipoDocumento = $("#tipo_documento" + id).val();
    var Identificacion = $("#identificacion" + id).val();
    var Direccion = $("#direccion" + id).val();
    var Ciudad = $("#ciudad" + id).val();
    var Estado = $("#estado" + id).val();
    var Comentario = $("#comentario" + id).val();
    var RadicadoSalida = $("#radicado_salida" + id).val();
    var Anexos = $("#anexos" + id).val();
    var IdPersona = $("#id_persona" + id).val();

    $("#idRadicado_end").val(id);
    $("#end_radicado").val(Radicado);
    $("#end_asunto").val(Asunto);
    $("#end_destinatario").val(Destinatario);
    $("#end_nombre_ciudadano").val(NombreCiudadano);
    $("#end_tipo_documento").val(TipoDocumento);
    $("#end_identificacion").val(Identificacion);
    $("#end_direccion").val(Direccion);
    $("#end_ciudad").val(Ciudad);
    $("#end_comentario").val(Comentario);
    $("#end_radicado_salida").val(RadicadoSalida);
    $("#end_id_persona").val(IdPersona);

    $("#VerAnexosEnd").click(function(){
        document.getElementById('anexosRadicadoEnd').innerHTML = Anexos;
    });

    var x = document.getElementById("mod_radicado_salida_end");

    if(Estado == '2'){
        // x.style.display = "block";
        document.getElementById("end_destinatario").readOnly = true;
        document.getElementById("end_nombre_ciudadano").readOnly = true;
        $('#end_tipo_documento').prop('disabled', 'disabled');
        document.getElementById("end_identificacion").readOnly = true;
        document.getElementById("end_direccion").readOnly = true;
        document.getElementById("end_ciudad").readOnly = true;
        document.getElementById("end_comentario").readOnly = true;
        document.getElementById("end_radicado_salida").readOnly = true;
        document.getElementById("end_comentario").required = true;
        document.getElementById("end_radicado_salida").required = true;
    }else{
        document.getElementById("end_comentario").readOnly = true;
        document.getElementById("end_radicado_salida").readOnly = true;
        document.getElementById("end_destinatario").readOnly = true;
        document.getElementById("end_nombre_ciudadano").readOnly = true;
        $('#end_tipo_documento').prop('disabled', 'disabled');
        document.getElementById("end_identificacion").readOnly = true;
        document.getElementById("end_direccion").readOnly = true;
        document.getElementById("end_ciudad").readOnly = true;
    }

}

$('#form-crear_radicado').submit(function () {
    var fileInputP = document.getElementById('anexos');
    var Procedimientos = fileInputP.value;
    if (Procedimientos) {
        var fileSize = $('#anexos')[0].files[0].size;
        var sizekiloBytes = parseInt(fileSize / 1024);
        if (sizekiloBytes > $('#anexos').attr('size')) {
            alert('El tamaño supera el limite permitido de 5mb');
            return false;
        }
    }
});

$('#form-actualizar_radicado').submit(function () {
    var fileInputP = document.getElementById('anexo_salida');
    var Procedimientos = fileInputP.value;
    if (Procedimientos) {
        var fileSize = $('#anexo_salida')[0].files[0].size;
        var sizekiloBytes = parseInt(fileSize / 1024);
        if (sizekiloBytes > $('#anexo_salida').attr('size')) {
            alert('El tamaño supera el limite permitido de 2mb');
            return false;
        }
    }
});

$('#form-finalizar_radicado').submit(function () {
    var fileInputP = document.getElementById('anexo_salida');
    var Procedimientos = fileInputP.value;
    if (Procedimientos) {
        var fileSize = $('#anexo_salida')[0].files[0].size;
        var sizekiloBytes = parseInt(fileSize / 1024);
        if (sizekiloBytes > $('#anexo_salida').attr('size')) {
            alert('El tamaño supera el limite permitido de 2mb');
            return false;
        }
    }
});
