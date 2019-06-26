<?php

namespace App\Models;

use Eloquent as Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class comment_gonggao extends Model
{
    use SoftDeletes;

    public $table = 'comment_gonggao';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'gonggao_id',
        'user_id',
        'content'
    ];
/*
           $table->integer('gonggao_id')->comment('公告id');
            $table->integer('user_id')->comment('用户id');
            $table->string('content')->comment('评论内容');
 */
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'gonggao_id' => 'integer',
        'user_id' => 'integer',
        'content'=>'string'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function gonggao(){
        return $this->belongsTo('App\Models\gonggao');
    }

    public function getuserobjAttribute(){
        $user=User::find($this->user_id);
        return $user;
    }

}
