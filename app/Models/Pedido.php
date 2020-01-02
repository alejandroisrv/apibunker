<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cliente_id',
        'direccion',
        'referencia',
        'telefono',
        'pago',
        'monto',
        'fecha',
        'status',
        'orden'
    ];

    public function productos(){
        return $this->hasMany(PedidoProductos::class,'pedido_id');
    }
}
