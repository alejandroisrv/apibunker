<?php


namespace App\Models\Admin;

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
        'observaciones',
        'fecha_creacion'
    ];



    public function productos(){
        return $this->hasMany(PedidoProductos::class,'pedido_id');
    }

    public function cliente(){
        return $this->belongsTo('App\Models\Api\Cliente','cliente_id');

    }


}
