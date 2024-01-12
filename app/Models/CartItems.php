<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cart_items';
    protected $fillable = ['quantity'];
    
}
