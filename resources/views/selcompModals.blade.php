<div class="modal fade" id="modalExitoso" tabindex="-1" Radicadoe="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" Radicadoe="document">
        <div class="modal-content" id="modalInicio">
            <div class="container" id="imageModal">
                <br><br>
                <center>
                    <picture>
                        <source srcset="{{asset("images/check.webp")}}" type="image/webp"/>
                        <source srcset="{{asset("images/check.png")}}" type="image/png"/>
                        <img src="{{asset("images/check.webp")}}" id="imgAlerts">
                    </picture>
                </center>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p id="exitoAlert"></p>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="location.reload()">Cerrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalError" tabindex="-1" Radicadoe="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" Radicadoe="document">
        <div class="modal-content" id="modalInicio">
            <div class="container" id="imageModal">
                <br><br>
                <center>
                    <picture>
                        <source srcset="{{asset("images/uncheck.webp")}}" type="image/webp"/>
                        <source srcset="{{asset("images/uncheck.png")}}" type="image/png"/>
                        <img src="{{asset("images/uncheck.webp")}}" id="imgAlerts">
                    </picture>
                </center>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p id="errorAlert"></p>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" id="modal-radicadoUpd" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-primary">Actualizar Radicado</h4>
            </div>
            {!! Form::open(['url' => 'actualizarRadicado', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-actualizar_Radicado']) !!}
            @csrf
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id_radicado_upd" id="idRadicado_upd">
                    <input type="hidden" name="id_persona_upd" id="upd_id_persona">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nro. Radicado</label>
                            {!! Form::text('radicado_upd',null,['class'=>'form-control','id'=>'upd_radicado','placeholder'=>'Nombre Ciudadano','required','readonly']) !!}
                        </div>
                        <div class="col-md-8">
                            <label for="exampleInputEmail1">Asunto Solicitud</label>
                            {!! Form::text('asunto_upd',null,['class'=>'form-control','id'=>'upd_asunto','placeholder'=>'Asunto Solicitud','required','readonly']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nombre Ciudadano</label>
                            {!! Form::text('nombre_ciudadano_upd',null,['class'=>'form-control','id'=>'upd_nombre_ciudadano','placeholder'=>'Nombre Ciudadano','required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Tipo Documento</label>
                            {!! Form::select('tipo_documento_upd',$TipoDocumento,null,['class'=>'form-control','id'=>'upd_tipo_documento','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">No. Documento</label>
                            {!! Form::text('identificacion_upd',null,['class'=>'form-control','id'=>'upd_identificacion','placeholder'=>'No. Documento','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Dirección</label>
                            {!! Form::text('direccion_upd',null,['class'=>'form-control','id'=>'upd_direccion','placeholder'=>'Dirección','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Ciudad Residencia</label>
                            {!! Form::text('ciudad_upd',null,['class'=>'form-control','id'=>'upd_ciudad','placeholder'=>'Ciudad Residencia','required']) !!}
                        </div>

                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Destinatario</label>
                            {!! Form::text('destinatario_upd',null,['class'=>'form-control','id'=>'upd_destinatario','placeholder'=>'Destinatario','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group" id="mod_radicado_salida">
                    <div class="row" >
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nro. Radicado Salida</label>
                            {!! Form::text('radicado_salida_upd',null,['class'=>'form-control','id'=>'upd_radicado_salida','placeholder'=>'Nombre Ciudadano']) !!}
                        </div>
                        <div class="col-md-8">
                            <label for="exampleInputEmail1">Respuesta</label>
                            {!! Form::text('comentario_upd',null,['class'=>'form-control','id'=>'upd_comentario','placeholder'=>'Asunto Solicitud']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" id="VerAnexos" class="btn btn-success">Ver Anexos</button>
                        </div>
                        <div class="col-md-9">
                            <div id="anexosRadicado"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Actualizar Radicado</button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl" id="modal-radicadoEnd" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-primary">Tramite Radicado</h4>
            </div>
            {!! Form::open(['url' => 'finalizarRadicado', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-finalizar_Radicado']) !!}
            @csrf
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id_radicado_end" id="idRadicado_end">
                    <input type="hidden" name="id_persona_end" id="end_id_persona">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nro. Radicado</label>
                            {!! Form::text('radicado_end',null,['class'=>'form-control','id'=>'end_radicado','placeholder'=>'Nombre Ciudadano','required','readonly']) !!}
                        </div>
                        <div class="col-md-8">
                            <label for="exampleInputEmail1">Asunto Solicitud</label>
                            {!! Form::text('asunto_end',null,['class'=>'form-control','id'=>'end_asunto','placeholder'=>'Asunto Solicitud','required','readonly']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nombre Ciudadano</label>
                            {!! Form::text('nombre_ciudadano_end',null,['class'=>'form-control','id'=>'end_nombre_ciudadano','placeholder'=>'Nombre Ciudadano','required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Tipo Documento</label>
                            {!! Form::select('tipo_documento_end',$TipoDocumento,null,['class'=>'form-control','id'=>'end_tipo_documento','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">No. Documento</label>
                            {!! Form::text('identificacion_end',null,['class'=>'form-control','id'=>'end_identificacion','placeholder'=>'No. Documento','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Dirección</label>
                            {!! Form::text('direccion_end',null,['class'=>'form-control','id'=>'end_direccion','placeholder'=>'Dirección','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Ciudad Residencia</label>
                            {!! Form::text('ciudad_end',null,['class'=>'form-control','id'=>'end_ciudad','placeholder'=>'Ciudad Residencia','required']) !!}
                        </div>

                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Destinatario</label>
                            {!! Form::text('destinatario_end',null,['class'=>'form-control','id'=>'end_destinatario','placeholder'=>'Destinatario','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="exampleInputEmail1">Anexo Salida</label>
                            <input type="file" id="anexo_salida" name="anexo_salida" class="form-control" size="2048" required>
                            <div align="right"><small class="text-muted" style="font-size: 63%;">Tamaño maximo permitido (2MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                        </div>
                        <div class="col-md-7">
                            <label for="exampleInputEmail1">Respuesta Solicitud</label>
                            {!! Form::text('respuesta',null,['class'=>'form-control','id'=>'respuesta','placeholder'=>'Respuesta Solicitud','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" id="VerAnexosEnd" class="btn btn-success">Ver Anexos</button>
                        </div>
                        <div class="col-md-9">
                            <div id="anexosRadicadoEnd"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Finalizar Radicado</button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl" id="modal-reportes" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-primary">Tramite Radicado</h4>
            </div>
            <div class="modal-body">
                <table id="reporte" class="display table dt-responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Radicado Entrada</th>
                            <th>Fecha Radicado</th>
                            <th>Remitente</th>
                            <th>Radicado Respuesta</th>
                            <th>Fecha Respuesta</th>
                            <th>Quien Contesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Reporte as $value)
                            <tr>
                                <td>{{$value['radicado_entrada']}}</td>
                                <td>{{$value['fecha_radicado']}}</td>
                                <td>{{$value['remitente']}}</td>
                                <td>{{$value['radicado_respuesta']}}</td>
                                <td>{{$value['fecha_respuesta']}}</td>
                                <td>{{$value['usuario']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
