<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyUsage extends Model
{
    use HasFactory;
    
    protected $table = 'daily_usage';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'date_used',
        'vaccine_id',
        'stocks_used',
    ];
}