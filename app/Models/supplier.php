<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $fillable=['supplier_name','supplier_product_name','supplier_phone','supplier_email','supplier_address','supplier_TRN'];
}
