<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//Importar la facade para la clase DB
use Illuminate\Support\Facades\DB;

class Jornada extends Model
{
    use HasFactory;

    protected $fillable =[
        'nombre', 'fecha', 'localidad', 'municipio'
    ];

    /*
    Regresa la columna especifica, saltandose las entradas que sean NULL
    */
    /*Probablemente es basura pero la dejo por cualquier cosa
    public static function getColumn($col){
        $query = DB::table("jornadas as j")
                    ->select("j." . $col);
        $results = $query->get();
        $jornadas = [];
        foreach ($results as $jornada){
            $jornadas[] = [
            "columna" => $jornada->$col
            ];
        }
        return $jornadas;
    }
    */

    public static function getAllJornadas(){
        $query = DB::table("jornadas as j")
                    ->select("j.id","j.nombre", "j.fecha", "j.localidad", "j.municipio")
                    ->orderBy("j.nombre", "asc");
        
        $results = $query->get();
        $jornadas = [];
        foreach ($results as $jornada){
            $jornadas[] = [
                "id" => $jornada->id,
                "nombre" => $jornada->nombre,
                "fecha" => $jornada->fecha,
                "localidad" => $jornada->localidad,
                "municipio" => $jornada->municipio
            ];
        }
        
        return $jornadas;
    }

    public function beneficiarios(){
        return $this->belongsToMany(Beneficiario::class)->withTimestamps();;
    }
}
