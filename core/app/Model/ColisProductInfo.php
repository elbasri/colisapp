<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ColisProductInfo extends Model {

    protected $table = "colis_product_infos";
    // table fields
    protected $guarded = [];

    public function colis_info() {
        return $this->belongsTo(ColisInfo::class);
    }

    public function colis_types() {
        return $this->belongsTo(ColisType::class, 'colis_type');
    }

}
