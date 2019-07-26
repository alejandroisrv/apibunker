<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model{

    protected $fillable = ['product_id','order_id','cantidad','precio','detalle'];

    public function product(){
        return $this->belognsTo('App\User','user_id','id');
    }

    public function order(){
        return $this->belognsTo('App\Order','order_id');
    }


    





}
