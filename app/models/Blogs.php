<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'lang_id',
        'medical_type_id',
        'name',
        'description',
        'thumbnail',
        'blog',
        'blog_type',
        'delete_status',
        'created_at',
        'updated_at'
    ];
    #get medical types
    public function medicalType(){
        return $this->belongsTo('App\models\MedicalType','medical_type_id','id');
    }
}
