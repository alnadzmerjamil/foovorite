<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory;
    public function order() {
        return $this->belongsTo('\App\Models\Order');
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
}
