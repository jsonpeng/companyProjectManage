<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gonggao extends Model
{
    use SoftDeletes;

    public $table = 'gonggao';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'desc',
        'author',
        'dianzan',
        'watch'
    ];
    /*
                $table->string('author')->comment('发布者');
                $table->integer('dianzan')->nullable()->default(0)->comment('点赞数');
                $table->integer('watch')->nullable()->default(0)->comment('浏览量');
     */
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'desc' => 'string',
        'author' => 'string',
        'dianzan' => 'integer',
        'watch' => 'integer'
    ];

    //评论
    public function comment()
    {
        return $this->hasMany('App\Models\comment_gonggao');

    }

    public function getuserobjAttribute(){
        $user=User::where('name',$this->author)->first();
        return $user;
    }
}
