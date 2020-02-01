<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'cliente_id',
        'tipo',
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
