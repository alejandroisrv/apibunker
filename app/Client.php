<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class Client extends Model{
   

    protected $fillable = ['name','email','password','api_token','direccion','numero'];
    protected $hidden = ['password'];

    public function orders(){
        return $this->hasMany('App\Order','user_id','id');

    }





}
