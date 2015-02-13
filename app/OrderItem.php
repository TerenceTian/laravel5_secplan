<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

	protected $table = 'order_items';

    protected $guarded = ['id'];

    public function order() {
        $this->belongsTo('App\Order');
    }

    public function item() {
        $this->hasOne('App\Item');
    }

}
