<?php

namespace App\Models;

use Eloquent as Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class products
 * @package App\Models
 * @version November 8, 2017, 1:35 am UTC
 *
 * @property string name
 * @property string des
 */
class products extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'des',
        'main_man',
        'whether_project'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'des' => 'string',
        'main_man'=>'string',
        'whether_project'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string|required',
        'des' => 'string|required'
    ];


    /*
     * 所属产品分类
     */
    public function cats(){
        return $this->belongsToMany('App\Models\productcats','productcat_product','product_id','productcat_id');
    }

    /*
     * 参与用户
     */
    public function users(){
        return $this->belongsToMany('App\User','product_user','product_id','user_id')->withPivot('created_at', 'prop');
    }

    //转换成的项目
    public function projects()
    {
        return $this->hasMany('App\Models\project');
    }


        //通过负责人的名字获取到负责人的id
    public function getmainmanidAttribute()
    {
        $id=User::where('name',$this->main_man)->first()->id;
        return $id;
    }

}
