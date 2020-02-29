<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{

    protected $table = 'productos';
    public $timestamps = false;

    protected $primaryKey = 'idproductos';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'descripcion',
        'precio',
        'precionoche',
        'cantidad',
        'imagen',
        'logo',
        'pais',
        'tipo',
        'ventas',
        'vistas'
    ];

    public function categoria()
    {
        return $this->belongsTo(ProductoCategoria::class, 'categoria_id');
    }
}
