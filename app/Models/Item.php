<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
   use SoftDeletes;
    public function resto() {
        return $this->belongsTo('\App\Models\Restaurant');
    }
     public function category() {
        return $this->belongsTo('\App\Models\Category');
    }
}
