<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'items';

	protected $guarded = ['id'];

	public function shop() {
		return $this->belongsTo('App\Shop');
	}

	public function orders() {
		return $this->hasMany('App\OrderItems');
	}

	public function scopePopular($query) {
		return $query->with('shop.user')->orderBy('favourite_count', 'desc');
	}

	public function scopeRecent($query) {
		return $query->with('shop.user')->orderBy('created_at', 'desc');
	}
}
