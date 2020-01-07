<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';
    public $timestamps = false;
    
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
