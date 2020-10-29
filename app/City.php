<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    public function division() {
        return $this->belongsTo(Division::class);
    }
    public function areas() {
        return $this->hasMany(Area::class);
    }
}
