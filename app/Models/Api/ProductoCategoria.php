<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{

    protected $table = 'productos_categorias';

    protected $fillable = ['nombre','imagen','alias'];
    public $timestamps = false;


    public function productos(){
        return $this->hasMany(Producto::class,'categoria_id');
    }
}
