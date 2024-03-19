<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=['purchase_id','price','discount','description'];
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
