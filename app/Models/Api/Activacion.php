<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Activacion extends Model
{
    protected $table = "clientes_activations";

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'fecha_creacion'
    ];
}
