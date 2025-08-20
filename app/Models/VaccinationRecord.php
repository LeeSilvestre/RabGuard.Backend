<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationRecord extends Model
{
    use HasFactory;

    protected $table = 'vaccination_record';

    protected $primaryKey = 'vacc_id';

    protected $fillable = [
        'user_id',
        'expdate',
        'expplace',
        'exptype',
        'expsource',
        'expsite',
        'date0',
        'date3',
        'date7',
        'expcateg',
        'wash',
        'vaccine',
        'day0',
        'day3',
        'day7',
        'day28',
        'doc_id',
        'status',
        'is_queued',
        'is_done',
        'date28',
        'booster',
        'boost_date',
        'is_updated'
    ];

    public $timestamps = false; 
}
