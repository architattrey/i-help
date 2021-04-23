<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MedicalType extends Model
{
    protected $table = 'medical_types';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'medical_type',
        'delete_status',
        'created_at',
        'updated_at'
    ];

    
}
