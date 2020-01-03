<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{

    protected $table = 'categorias';

    protected $fillable = ['nombre','alias'];


    public function productos(){
        return $this->hasMany(Producto::class,'categoria_id');
    }
}
