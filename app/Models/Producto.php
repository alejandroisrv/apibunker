<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public $appends = ['favorite'];

    public function categoria()
    {
        return $this->belongsTo(ProductoCategoria::class, 'categoria_id');
    }


    public function getFavoriteAttribute(){

        $user = Auth::user(); 
        return  $user->favorites()->where('id_producto',$this->id)->exists();

    }

}
