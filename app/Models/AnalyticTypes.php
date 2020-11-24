<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticTypes extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'analytic_types';
    protected $dates = [
        'create_at',
        'update_at'
    ];

    protected $fillable = [
        'name',
        'units',
        'is_numeric',
        'num_decimal_places',
        'create_at',
        'update_at'
    ];
}
