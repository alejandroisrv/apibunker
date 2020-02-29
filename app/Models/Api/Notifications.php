<?php


namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'cliente_id',
        'tipo',
        'titulo',
        'contenido',
        'estado',
        'fecha_creacion'
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
