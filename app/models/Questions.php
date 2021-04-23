<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'video_id',
        'blog_id',
        'lang_id',
        'type',
        'question',
        'option_one',
        'option_two',
        'option_three',
        'option_four',
        'created_at',
        'updated_at'
    ];
    #get video
    public function video(){
        return $this->belongsTo('App\models\Video','video_id','id');
    }
    #get blog
    public function blog(){
        return $this->belongsTo('App\models\Blogs','blog_id','id');
    }
    #get language
    public function language(){
        return $this->belongsTo('App\models\Languages','lang_id','id');
    }
}
