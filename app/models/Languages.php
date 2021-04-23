<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $table = 'languages';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'languages',
        'created_at',
        'updated_at'
    ];
}
