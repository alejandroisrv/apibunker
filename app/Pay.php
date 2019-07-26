<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class Pay extends Model{

    protected $fillable = ['user_id','order_id','estado','monto','fecha_pagado'];

    public function user(){
        return $this->belognsTo('App\User','user_id','id');
    }

    public function order(){
        return $this->belognsTo('App\Order','order_id');
    }


    





}
