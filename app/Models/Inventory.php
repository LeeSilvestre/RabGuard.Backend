<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    
    protected $table = 'inventory';
    protected $primaryKey = 'vaccine_id';
    public $timestamps = false;

    protected $fillable = [
        'generic_name',
        'brand_name',
        'hand_stocks',
        'halfed',
        'used_today',
        'total',
        'warning'
    ];
}