<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAnalytics extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'property_analytics';
    protected $dates = [
        'create_at',
        'update_at'
    ];
    protected $fillable = [
        'property_id',
        'analytic_type_id',
        'value'
    ];
}
