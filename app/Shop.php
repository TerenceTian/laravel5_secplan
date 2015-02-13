<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

	protected $table = 'shops';

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function scopePopular($query) {
        return $query->orderBy('favourite_count', 'desc');
    }

    public function scopeRecent($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
