<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

	protected $table = 'shops';

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function items() {
        return $this->hasMany('App\Items');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function scopePopular($query) {
        return $query->with('user')->orderBy('favourite_count', 'desc');
    }

    public function scopeRecent($query) {
        return $query->with('user')->orderBy('created_at', 'desc');
    }

}
