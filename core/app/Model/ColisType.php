<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Unit;

class ColisType extends Model {

    protected $table = "colis_types";
    // table fields
    protected $guarded = [];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function colis_product_infos() {
        return $this->hasMany(ColisProductInfo::class);
    }

}
