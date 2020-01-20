<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Cliente extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "clientes";

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'email',
        'foto_perfil',
        'password',
        'telefono',
        'direccion',
        'verificado',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function favorites(){
        return $this->belongsToMany(Producto::class, 'clientes_favoritos', 'id_cliente', 'id_producto');
    }

    public function cart(){
        return $this->belongsToMany(Producto::class,'clientes_carrito','id_cliente','id_productos')->withPivot('cantidad','fecha');
    }


}
