<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'lang_id',
        'medical_type_id',
        'name',
        'description',
        'thumbnail',
        'video',
        'video_type',
        'delete_status',
        'created_at',
        'updated_at'
    ];
    #get medical types
    public function medicalType(){
        return $this->belongsTo('App\models\MedicalType','medical_type_id','id');
    }
}
