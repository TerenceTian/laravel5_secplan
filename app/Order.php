<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';

    protected $guard = ['id'];

    public function seller() {
        return $this->belongsTo('App\User');
    }

    public function shop() {
        return $this->belongsTo('App\Shop');
    }

    public function orderItems() {
        return $this->hasMany('App\OrderItem');
    }

}
