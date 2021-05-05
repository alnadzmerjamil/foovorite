<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
    public function order_items() {
        return $this->hasMany('\App\Models\Order_Item');
    }
}
