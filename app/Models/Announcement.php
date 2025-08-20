<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'announcement';

    // Primary key for the table
    protected $primaryKey = 'ann_id';

    // Fields that are mass assignable
    protected $fillable = [
        'message',
        'ann_date',
        'ann_exp',
        'is_active'
    ];

    // Set the timestamps to false as your table doesn't have created_at and updated_at fields
    public $timestamps = false;
}
