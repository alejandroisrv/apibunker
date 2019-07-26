<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model{

    protected $fillable = ['user_id','order_id','estado','monto','fecha_pagado'];

    public function user(){
        return $this->belognsTo('App\User','user_id','id');
    }

    public function client(){
        return $this->belognsTo('App\User','client_id','id');
    }

    public function order(){
        return $this->belognsTo('App\Order','order_id');
    }

    public function details(){
        return $this->hasMany('App\OrderDetail');

    }


    





}
