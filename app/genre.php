<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    // the relationship is to-many so it is plural.
    public function records() {
        // a genre has many records
        return $this->hasMany('App\Record');   // a genre has many records
    }
}
