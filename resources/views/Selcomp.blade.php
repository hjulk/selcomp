<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="image/x-icon" rel="icon" href="{{asset("images/favicon.ico")}}">
        <title>Selcomp</title>
        <link rel="stylesheet" href="{{asset("css/adminlte.min.css")}}">
        <link rel="stylesheet" href="{{asset("DataTables/DataTables/css/jquery.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("DataTables/DataTables/css/dataTables.bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("DataTables/Responsive/css/responsive.bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("DataTables/Buttons/css/buttons.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("DataTables/AutoFill/css/autofill.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/toastr.min.css")}}">
        <link rel="stylesheet" href="{{asset("fontawesome-free/css/all.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/selcomp.css")}}">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>

        <section>
            <div class="container">
                <div class="container-fluid">
                    <br>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark" style="color:#dc1547 !important;"><i class="fas fa-file nav-icon" id="enlace"></i> ORFEO MSPS - SELCOMP</h1>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><strong>Crear Radicado</strong></h3>
                            </div>
                            {!! Form::open(['url' => 'crearRadicado', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-crear_radicado']) !!}
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Nombre Ciudadano</label>
                                            {!! Form::text('nombre_ciudadano',null,['class'=>'form-control','id'=>'nombre_ciudadano','placeholder'=>'Nombre Ciudadano','required']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Tipo Documento</label>
                                            {!! Form::select('tipo_documento',$TipoDocumento,null,['class'=>'form-control','id'=>'tipo_documento','required']) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1">No. Documento</label>
                                            {!! Form::text('identificacion',null,['class'=>'form-control','id'=>'identificacion','placeholder'=>'No. Documento','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            {!! Form::text('direccion',null,['class'=>'form-control','id'=>'direccion','placeholder'=>'Dirección','required']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Ciudad Residencia</label>
                                            {!! Form::text('ciudad',null,['class'=>'form-control','id'=>'ciudad','placeholder'=>'Ciudad Residencia','required']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Asunto Solicitud</label>
                                            {!! Form::text('asunto',null,['class'=>'form-control','id'=>'asunto','placeholder'=>'Asunto Solicitud','required']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Destinatario</label>
                                            {!! Form::text('destinatario',null,['class'=>'form-control','id'=>'destinatario','placeholder'=>'Destinatario','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Anexos</label>
                                            <input type="file" id="anexos[]" name="anexos[]" class="form-control" multiple="multiple" size="5200" required>
                                            <div align="right"><small class="text-muted" style="font-size: 63%;">Tamaño maximo permitido (5MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right">Crear Radicado</button>
                            </div>
                            {!!  Form::close() !!}
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-left" data-toggle="modal" data-target="#modal-reportes">Reporte</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="radicados" class="display table dt-responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tipo</th>
                                            <th>No. Radicado</th>
                                            <th>Asunto</th>
                                            <th>Destinatario</th>
                                            <th>Fecha Creación</th>
                                            <th>Estado Radicado</th>
                                            <th>Usuario Radicado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Radicados as $value)
                                            <tr>
                                                <td>{{$value['id']}}</td>
                                                <td>{{$value['tipo_radicado']}}</td>
                                                <td>{{$value['radicado']}}</td>
                                                <td>{{$value['asunto']}}</td>
                                                <td>{{$value['destinatario']}}</td>
                                                <td>{{$value['fecha_creacion']}}</td>
                                                <td><span class="{{$value['label']}}" style="font-size:1rem;text-align:center;"><b>{{$value['estado_radicado']}}</b></span></td>
                                                <td>{{$value['usuario']}}</td>
                                                <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modal-radicadoUpd" onclick="obtener_datos_radicado('{{$value['id']}}');"><i class="fas fa-edit"></i></a>&nbsp;
                                                    {!!$value['boton']!!}
                                                </td>
                                                <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                                                <input type="hidden" value="{{$value['tipo']}}" id="tipo{{$value['id']}}">
                                                <input type="hidden" value="{{$value['radicado']}}" id="radicado{{$value['id']}}">
                                                <input type="hidden" value="{{$value['asunto']}}" id="asunto{{$value['id']}}">
                                                <input type="hidden" value="{{$value['destinatario']}}" id="destinatario{{$value['id']}}">
                                                <input type="hidden" value="{{$value['anexos']}}" id="anexos{{$value['id']}}">
                                                <input type="hidden" value="{{$value['nombre_ciudadano']}}" id="nombre_ciudadano{{$value['id']}}">
                                                <input type="hidden" value="{{$value['tipo_documento']}}" id="tipo_documento{{$value['id']}}">
                                                <input type="hidden" value="{{$value['identificacion']}}" id="identificacion{{$value['id']}}">
                                                <input type="hidden" value="{{$value['direccion']}}" id="direccion{{$value['id']}}">
                                                <input type="hidden" value="{{$value['ciudad']}}" id="ciudad{{$value['id']}}">
                                                <input type="hidden" value="{{$value['id_persona']}}" id="id_persona{{$value['id']}}">
                                                <input type="hidden" value="{{$value['estado']}}" id="estado{{$value['id']}}">
                                                <input type="hidden" value="{{$value['comentario']}}" id="comentario{{$value['id']}}">
                                                <input type="hidden" value="{{$value['radicado_salida']}}" id="radicado_salida{{$value['id']}}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('selcompModals')
    </body>

    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="{{asset("js/jquery-migrate.min.js")}}"></script>
    <script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("js/adminlte.js")}}"></script>
    <script src="{{asset("DataTables/DataTables/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("DataTables/DataTables/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("DataTables/Responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("DataTables/Responsive/js/responsive.bootstrap4.min.js")}}"></script>
    <script src="{{asset("DataTables/Buttons/js/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("DataTables/Buttons/js/buttons.html5.min.js")}}"></script>
    <script src="{{asset("DataTables/Buttons/js/buttons.print.min.js")}}"></script>
    <script src="{{asset("DataTables/JsZip/jszip.min.js")}}"></script>
    <script src="{{asset("DataTables/pdfmake/pdfmake.min.js")}}"></script>
    <script src="{{asset("DataTables/pdfmake/vfs_fonts.js")}}"></script>
    <script src="{{asset("DataTables/AutoFill/js/dataTables.autoFill.min.js")}}"></script>
    <script src="{{asset("js/toastr.min.js")}}"></script>
    <script src="{{asset("js/selcomp.js")}}"></script>
    <script src="{{asset("js/jquery.validate.min.js")}}"></script>
    <script src="{{asset("js/additional-methods.min.js")}}"></script>
    <script>
        @if (session("mensaje"))
            $("#modalExitoso").modal("show");
            document.getElementById("exitoAlert").innerHTML = "{{ session("mensaje") }}";
        @endif

        @if (session("precaucion"))
            $("#modalError").modal("show");
            document.getElementById("errorAlert").innerHTML = "{{ session("precaucion") }}";
        @endif

        @if (count($errors) > 0)
            $("#modalError").modal("show");
            @foreach($errors -> all() as $error)
                document.getElementById("errorAlert").innerHTML = "{{ $error }}";
            @endforeach
        @endif
    </script>
</html>
