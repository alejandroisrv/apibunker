<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PedidoProductos extends Model
{

    protected $table = 'pedidos_productos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
