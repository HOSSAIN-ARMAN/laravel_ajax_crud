<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded;

    public function Cities () {
        return $this->belongsTo(City::class);
    }
    public function divisions () {
        return $this->belongsTo(Division::class);
    }
}
