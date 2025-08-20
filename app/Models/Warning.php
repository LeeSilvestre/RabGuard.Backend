<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;
    
    protected $table = 'warning';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'amount',
    ];
}