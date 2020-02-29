<?php

namespace App\Models\Api;

use App\Traits\Uuids;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Cliente extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable,Uuids;

    protected $table = "clientes";

    protected $guard = 'clientes';

    public $incrementing = false;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */

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
        return $this->belongsToMany(Producto::class, 'clientes_favoritos', 'id_cliente', 'id_producto')->orderBy('fecha_creacion','DESC');
    }

    public function cart(){
        return $this->belongsToMany(Producto::class,'clientes_carrito','id_cliente','id_producto')->withPivot('cantidad','fecha_creacion');
    }

    public function notifications(){
        return $this->hasMany(Notifications::class,'cliente_id');
    }


    public function pedidos(){
        return $this->hasMany(Pedido::class,'cliente_id');
    }
}