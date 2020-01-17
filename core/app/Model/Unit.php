<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ColisType;

class Unit extends Model {

    protected $table = "units";
    // table fields
    protected $guarded = [];

    public function colistypes() {
        return $this->hasMany(ColisType::class);
    }

}
