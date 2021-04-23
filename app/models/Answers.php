<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $table = 'answers';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'ques_id',
        'answer',
        'delete_status',
        'created_at',
        'updated_at'
    ];
   #get languaquestionse
   public function questions(){
    return $this->belongsTo('App\models\Questions','ques_id','id');
}
}
