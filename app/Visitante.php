<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $fillable = [ 'nombre', 'apellidos', 'tipo_documento', 'numero_documento','email','telefono', 'idNivel_formacion','idPrograma'];
}
