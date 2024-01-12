<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $table = 'invoices';
    protected $fillable = ['invoiceDate','totalPrice'];
}
