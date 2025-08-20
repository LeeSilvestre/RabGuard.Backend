<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'admin';

    // Primary key
    protected $primaryKey = 'admin_id';

    // Disable timestamps (created_at, updated_at)
    public $timestamps = false;

    // Fillable attributes
    protected $fillable = [
        'admin_username',
        'admin_password',
    ];
}
