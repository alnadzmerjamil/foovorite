<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
    public function resto() {
        return $this->belongsTo('\App\Models\Restaurant');
    }
    public function item() {
        return $this->belongsTo('\App\Models\Item');
    }
    public function rider() {
        return $this->belongsTo('\App\Models\Rider');
    }
    public function order_items() {
        return $this->hasMany('\App\Models\Order_Item');
    }
}
