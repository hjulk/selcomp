<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Selcomp extends Model
{
    use HasFactory;

    public static function ListRadicados(){
        $ListRadicados = DB::Select("SELECT * FROM radicado");
        return $ListRadicados;
    }

    public static function ListPersonaId($id){
        $ListPersonaId = DB::Select('SELECT * FROM personas WHERE id = ?', [$id]);
        return $ListPersonaId;
    }

    public static function ListRadicadosReporte(){
        $ListRadicados = DB::Select("SELECT * FROM radicado WHERE estado = 2 AND id_radicado_entrada IS NOT NULL");
        return $ListRadicados;
    }

    public static function ListRadicadoId($id){
        $ListRadicadoId = DB::Select('SELECT * FROM radicado WHERE id = ?', [$id]);
        return $ListRadicadoId;
    }

    public static function AnexoRadicado($id){
        $search = DB::select('SELECT * FROM radicado WHERE id = ?', [$id]);
        foreach($search as $value){
            $idRadicado = $value->id_radicado_entrada;
        }
        if($idRadicado){
            $AnexoRadicado = DB::Select('SELECT * FROM anexos WHERE id_radicado = ?', [$idRadicado]);
        }else{
            $AnexoRadicado = DB::Select('SELECT * FROM anexos WHERE id_radicado = ?', [$id]);
        }
        return $AnexoRadicado;
    }

    public static function CreateRadicado($nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$asunto,$destinatario){
        DB::Insert('INSERT INTO personas (nombres,tipo_identificacion,identificacion,direccion,ciudad)
                    VALUES (?,?,?,?,?)', [$nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad]);
        $IdPersona = DB::Select("SELECT MAX(id) AS id FROM personas");
        foreach($IdPersona as $value){
            $persona = $value->id;
        }
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $radicado = date('Y').'ER'.date('dmHis');
        $CrearRadicado = DB::Insert('INSERT INTO radicado (tipo_radicado,radicado,asunto,destinatario,fecha_creacion,usuario,id_persona,estado)
                                    VALUES (?,?,?,?,?,?,?,?)',
                                    [1,$radicado,$asunto,$destinatario,$fechaCreacion,1,$persona,1]);
        return $CrearRadicado;
    }

    public static function SearchLastRadicado(){
        $LastRadicado = DB::Select("SELECT MAX(id) AS id FROM radicado");
        foreach($LastRadicado as $value){
            $id = $value->id;
        }
        $SearchLastRadicado = DB::Select('SELECT * FROM radicado WHERE id = ?', [$id]);
        return $SearchLastRadicado;
    }

    public static function Anexos($filename,$idRadicado,$idPersona,$radicadoSalida){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($radicadoSalida){
            $estado = $usuario = 2;
        }else{
            $estado = $usuario = 1;
        }
        $Anexos = DB::insert('INSERT INTO anexos (nombre_anexo,id_radicado,id_persona,ubicacion,fecha_creacion,estado,usuario,id_radicado_salida)
                            VALUES (?,?,?,?,?,?,?,?)',
                            [$filename,$idRadicado,$idPersona,'anexos',$fechaCreacion,$estado,$usuario,$radicadoSalida]);
        return $Anexos;
    }

    public static function UpdateRadicado($nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$destinatario,$idRadicado,$idPersona){
        DB::update('UPDATE personas SET
                    nombres = ?,
                    tipo_identificacion = ?,
                    identificacion = ?,
                    direccion = ?,
                    ciudad = ?
                    WHERE id = ?',
                    [$nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$idPersona]);
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $UpdateRadicado = DB::update('UPDATE radicado SET destinatario = ?, fecha_actualizacion = ? WHERE id = ?', [$destinatario,$fechaActualizacion,$idRadicado]);
        return $UpdateRadicado;
    }

    public static function EndRadicado($nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$destinatario,$idRadicado,$idPersona,$comentario){
        DB::update('UPDATE personas SET
                    nombres = ?,
                    tipo_identificacion = ?,
                    identificacion = ?,
                    direccion = ?,
                    ciudad = ?
                    WHERE id = ?',
                    [$nombreCiudadano,$tipoDocumento,$identificacion,$direccion,$ciudad,$idPersona]);
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::update('UPDATE radicado SET destinatario = ?, fecha_actualizacion = ?, respuesta = ?,estado = 2 WHERE id = ?', [$destinatario,$fechaActualizacion,$comentario,$idRadicado]);
        $radicado = date('Y').'ES'.date('dmHis');
        $EndRadicado = DB::Insert('INSERT INTO radicado (tipo_radicado,radicado,asunto,destinatario,fecha_creacion,usuario,id_persona,estado,id_radicado_entrada,respuesta)
                                    VALUES (?,?,?,?,?,?,?,?,?,?)',
                                    [2,$radicado,$comentario,$destinatario,$fechaActualizacion,2,$idPersona,2,$idRadicado,$comentario]);
        return $EndRadicado;
    }

    public static function SearchLastRadicadoOut(){
        $LastRadicado = DB::Select("SELECT MAX(id) AS id FROM radicado WHERE tipo_radicado = 2");
        foreach($LastRadicado as $value){
            $id = $value->id;
        }
        $SearchLastRadicadoOut = DB::Select('SELECT * FROM radicado WHERE id = ? AND tipo_radicado = 2', [$id]);
        return $SearchLastRadicadoOut;
    }
}
