<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = "pedidos_app";
    
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'direccion',
        'logitud',
        'latitud',
        'referencia',
        'telefono',
        'tipo_pago',
        'total',
        'observaciones'
    ];

    			

    public function productos(){       
        return $this->hasMany(PedidoProductos::class,'pedido_id');
    }


}