<?php

namespace App\Http\Controllers;

use App\Models\Selcomp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

class SelcompController extends Controller
{

    public function index()
    {
        $ListRadicados = Selcomp::ListRadicados();
        $Radicados = array();
        $cont = 0;
        foreach($ListRadicados as $value){
            $Radicados[$cont]['id'] = (int)$value->id;
            $Radicados[$cont]['tipo'] = (int)$value->tipo_radicado;
            if((int)$value->tipo_radicado === 1){
                $Radicados[$cont]['tipo_radicado'] = 'Entrada';
            }else{
                $Radicados[$cont]['tipo_radicado'] = 'Salida';
            }
            $Radicados[$cont]['radicado'] = $value->radicado;
            $NumeroRadicado = $value->radicado;
            $Radicados[$cont]['asunto'] = $value->asunto;
            $Radicados[$cont]['destinatario'] = $value->destinatario;
            $Radicados[$cont]['fecha_creacion'] = date('d/m/Y h:i A', strtotime($value->fecha_creacion));
            $Radicados[$cont]['fecha_actualizacion'] = date('d/m/Y h:i A', strtotime($value->fecha_actualizacion));
            $Radicados[$cont]['estado'] = (int)$value->estado;
            if((int)$value->estado === 1){
                $Radicados[$cont]['estado_radicado'] = 'En tramite';
                $Radicados[$cont]['label']    = 'badge badge-warning';
                $Radicados[$cont]['boton']    = '<a href="#" class="btn btn-success" title="Finalizar" data-toggle="modal" data-target="#modal-radicadoEnd" onclick="finalizar_radicado('.(int)$value->id.');"><i class="fas fa-file-export"></i></a>';
            }else{
                $Radicados[$cont]['estado_radicado'] = 'Finalizado';
                $Radicados[$cont]['label']    = 'badge badge-success';
                $Radicados[$cont]['boton']    = null;
            }
            $Radicados[$cont]['id_persona'] = (int)$value->id_persona;
            $ListPersonaId = Selcomp::ListPersonaId((int)$value->id_persona);
            foreach($ListPersonaId as $row){
                $Radicados[$cont]['nombre_ciudadano'] = $row->nombres;
                $Radicados[$cont]['tipo_documento'] = $row->tipo_identificacion;
                $Radicados[$cont]['identificacion'] = $row->identificacion;
                $Radicados[$cont]['direccion'] = $row->direccion;
                $Radicados[$cont]['ciudad'] = $row->ciudad;
            }
            $Radicados[$cont]['anexos'] = null;
            $AnexoRadicado = Selcomp::AnexoRadicado((int)$value->id);
            $contadorAnexo = count($AnexoRadicado);
            if($contadorAnexo > 0){
                $contA = 1;
                foreach($AnexoRadicado as $row){
                    $salida = $row->id_radicado_salida;
                    if($salida){
                        $SalidaSearch = Selcomp::ListRadicadoId($salida);
                        foreach($SalidaSearch as $key){
                            $NumeroRadicado = $key->radicado;
                        }
                    }
                    $Radicados[$cont]['anexos'] .= "<p><a href='anexos/".$row->nombre_anexo."' target='_blank' class='btn btn-info'><i class='fa fa-file-archive-o'></i>&nbsp;Anexo Radicado $NumeroRadicado Nro. ".$contA."</a></p>";
                    $contA++;
                }
            }else{
                $Radicados[$cont]['anexos'] = null;
            }
            if($value->usuario == 1){
                $Radicados[$cont]['usuario'] = 'Usuario Radicado Entrada';
            }else{
                $Radicados[$cont]['usuario'] = 'Usuario Radicado Salida';
            }
            $Radicados[$cont]['comentario'] = $value->respuesta;
            if($value->id_radicado_entrada){
                $Radicados[$cont]['radicado_salida'] = $value->radicado;
            }else{
                $Radicados[$cont]['radicado_salida'] = null;
            }
            $cont++;
        }
        $TipoDocumento = array();
        $TipoDocumento[''] = 'Seleccione..';
        $TipoDocumento['CC'] = 'Cédula de Ciudadanía';
        $TipoDocumento['CE'] = 'Cédula de Extranjería';
        $TipoDocumento['PA'] = 'Pasaporte';
        $ListReporte = Selcomp::ListRadicadosReporte();
        $Reporte = array();
        $contr = 0;
        foreach($ListReporte as $report){
            $buscarEntrada = Selcomp::ListRadicadoId($report->id_radicado_entrada);
            foreach($buscarEntrada as $ent){
                $Reporte[$contr]['radicado_entrada'] = $ent->radicado;
                $Reporte[$contr]['fecha_radicado'] = date('d/m/Y h:i A', strtotime($ent->fecha_creacion));
            }
            $buscarPersona = Selcomp::ListPersonaId($report->id_persona);
            foreach($buscarPersona as $per){
                $Reporte[$contr]['remitente'] = $per->nombres;
            }
            $Reporte[$contr]['radicado_respuesta'] = $report->radicado;
            $Reporte[$contr]['fecha_respuesta'] = date('d/m/Y h:i A', strtotime($ent->fecha_creacion));
            $Reporte[$contr]['usuario'] = 'Usuario Radicado Salida';
        }
        return view('Selcomp',['Radicados' => $Radicados,'TipoDocumento' => $TipoDocumento,'Reporte' => $Reporte]);
    }

    public function CrearRadicado(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre_ciudadano' => 'required|max:255',
            'tipo_documento' => 'required',
            'identificacion' => 'required|max:15',
            'direccion' => 'required|max:255',
            'ciudad' => 'required|max:100',
            'asunto' => 'required',
            'destinatario' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to('/')->withErrors($validator)->withInput();
        }else{
            $nombreCiudadano = $request->nombre_ciudadano;
            $tipoDocumento = $request->tipo_documento;
            $identificacion = $request->identificacion;
            $direccion = $request->direccion;
            $ciudad = $request->ciudad;
            $asunto = $request->asunto;
            $destinatario = $request->destinatario;
            $crearRadicado = Selcomp::CreateRadicado($nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$asunto,$destinatario);
            if($crearRadicado){
                $SearchLastRadicado = Selcomp::SearchLastRadicado();
                foreach($SearchLastRadicado as $valor){
                    $idRadicado = $valor->id;
                    $radicado = $valor->radicado;
                    $idPersona = $valor->id_persona;
                }
                $destinationPath = null;
                $filename        = null;
                $radicadoSalida = null;
                if ($request->hasFile('anexos')) {
                    $files = $request->file('anexos');
                    $contador = 1;
                    foreach($files as $file){
                        $destinationPath    = public_path().'/anexos';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $filename           = $radicado.'_anexo_'.$contador.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarAnexo    = Selcomp::Anexos($filename,$idRadicado,$idPersona,$radicadoSalida);
                        $contador++;
                    }
                }
                $verrors = 'Se creo el radicado '.$radicado.' con éxito.';
                return Redirect::to('/')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al crear el radicado');
                return Redirect::to('/')->withErrors(['errors' => $verrors])->withInput();
            }
        }
    }

    public function ActualizarRadicado(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre_ciudadano_upd' => 'required|max:255',
            'tipo_documento_upd' => 'required',
            'identificacion_upd' => 'required|max:15',
            'direccion_upd' => 'required|max:255',
            'ciudad_upd' => 'required|max:100',
            'asunto_upd' => 'required',
            'destinatario_upd' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to('/')->withErrors($validator)->withInput();
        }else{
            $nombreCiudadano = $request->nombre_ciudadano_upd;
            $tipoDocumento = $request->tipo_documento_upd;
            $identificacion = $request->identificacion_upd;
            $direccion = $request->direccion_upd;
            $ciudad = $request->ciudad_upd;
            $destinatario = $request->destinatario_upd;
            $radicado = $request->radicado_upd;
            $idRadicado = $request->id_radicado_upd;
            $idPersona = $request->id_persona_upd;
            $actualizarRadicado = Selcomp::UpdateRadicado($nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$destinatario,$idRadicado,$idPersona);
            if($actualizarRadicado){
                $verrors = 'Se actualizo el radicado '.$radicado.' con éxito.';
                return Redirect::to('/')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el radicado');
                return Redirect::to('/')->withErrors(['errors' => $verrors])->withInput();
            }
        }
    }

    public function FinalizarRadicado(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre_ciudadano_end' => 'required|max:255',
            'tipo_documento_end' => 'required',
            'identificacion_end' => 'required|max:15',
            'direccion_end' => 'required|max:255',
            'ciudad_end' => 'required|max:100',
            'asunto_end' => 'required',
            'destinatario_end' => 'required',
            'respuesta' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to('/')->withErrors($validator)->withInput();
        }else{
            $nombreCiudadano = $request->nombre_ciudadano_end;
            $tipoDocumento = $request->tipo_documento_end;
            $identificacion = $request->identificacion_end;
            $direccion = $request->direccion_end;
            $ciudad = $request->ciudad_end;
            $destinatario = $request->destinatario_end;
            $radicado = $request->radicado_end;
            $idRadicado = $request->id_radicado_end;
            $idPersona = $request->id_persona_end;
            $comentario = $request->respuesta;
            $finalizarRadicado = Selcomp::EndRadicado($nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$destinatario,$idRadicado,$idPersona,$comentario);
            if($finalizarRadicado){
                $SearchLastRadicado = Selcomp::SearchLastRadicadoOut();
                foreach($SearchLastRadicado as $valor){
                    $idRadicadoSalida = $valor->id;
                    $radicadoSalida = $valor->radicado;
                }
                if ($request->hasFile('anexo_salida')) {
                    $file = $request->file('anexo_salida');
                    $destinationPath    = public_path().'/anexos';
                    $extension          = $file->getClientOriginalExtension();
                    $name               = $file->getClientOriginalName();
                    $filename           = $radicadoSalida.'_anexo.'.$extension;
                    $uploadSuccess      = $file->move($destinationPath, $filename);
                    $archivofoto        = file_get_contents($uploadSuccess);
                    $NombreFoto         = $filename;
                    $actualizarAnexo    = Selcomp::Anexos($filename,$idRadicado,$idPersona,$idRadicadoSalida);
                }
                $verrors = 'Se actualizo el radicado '.$radicadoSalida.' con éxito.';
                return Redirect::to('/')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el radicado');
                return Redirect::to('/')->withErrors(['errors' => $verrors])->withInput();
            }
        }
    }
}
