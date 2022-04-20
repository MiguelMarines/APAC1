<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Beneficiario extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nombreBeneficiario', 'fechaNacimiento', 'genero', 'curp', 'diagnostico', 'tipoSangre', 'email', 'telefono', 'municipio', 'observacion','fecharegistro'
    ];

    protected $table = "beneficiarios";

    //Regresa las jornadas a las que pertenece un beneficiario
    public function jornadas()
    {
        return $this->belongsToMany(Jornada::class)->withTimestamps();
    }

    public function getJornadaName()
    {
        $name = $this->jornadas->pluck("nombre");
        //head($name);
        return $name[0];
    }
    //Regresa el atributo edad parseado con Carbon a partir de la fecha de Nacimiento.
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['fechaNacimiento'])->age;
    }

    // public function notas()
    // {
    //     return $this->hasMany(Notas::class);
    // }


    // public function micro()
    // {
    //     return $this->hasMany(micro::class);
    // }


    // public function depuracionCreatininas()
    // {
    //     return $this->hasMany(DepuracionCreatinina::class);
    // }


    // public function consulta()
    // {
    //     return $this->hasMany(consulta::class);
    // }

    public function nefropediatria()
    {
        return $this->hasMany(nefropediatria::class);
    }
    
}
