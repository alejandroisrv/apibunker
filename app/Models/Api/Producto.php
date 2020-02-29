<?php


namespace App\Models\Api;


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

    public $appends = ['favorite'];

    public function categoria()
    {
        return $this->belongsTo(ProductoCategoria::class, 'categoria_id');
    }


    public function getFavoriteAttribute()
    {

        $user = Auth::user();

        $exists = DB::table('clientes_favoritos')->where('id_producto', $this->id)->where('id_cliente', $user->id)->exists();
        return  $exists;
    }
}
