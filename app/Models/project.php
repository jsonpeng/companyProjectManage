<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class project
 * @package App\Models
 * @version November 8, 2017, 6:25 am UTC
 *
 * @property string name
 * @property string type
 * @property string main_man
 * @property string start_time
 * @property string status
 * @property string des
 * @property float price
 */
class project extends Model
{
    use SoftDeletes;

    public $table = 'projects';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'type',
        'main_man',
        'start_time',
        'end_time',
        'status',
        'des',
        'price',
        'products_id',
        'basic_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string',
        'main_man' => 'string',
        'start_time' => 'string',
        'end_time'=>'string',
        'status' => 'string',
        'des' => 'string',
        'price' => 'float',
        'products_id'=>'integer',
        'basic_time'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string|required',
    ];

    /*
     * 有哪些用户参与
     */
    public function users(){
        return $this->belongsToMany('App\User','project_user','project_id','user_id')->withPivot('created_at', 'prop');
    }
    /*
     * 由**产品转换
     */
    public function products(){
        return $this->belongsTo('App\Models\products');
    }

    //可用工时
    public function getcanusetimeAttribute(){
        $now=strtotime(Carbon::now());
        $end_time=strtotime($this->end_time);
        //return 'now:'.$now.'end:'.$end_time;
        if($now> $end_time || !empty($this->basic_time)){
            return '--';
        }else {
            return $this->timediff($now, $end_time);
        }
    }

    //计算时间差分时秒
    protected function  timediff($begin_time,$end_time){
        if($begin_time < $end_time){
            $starttime = $begin_time;
            $endtime = $end_time;
        }else{
            $starttime = $end_time;
            $endtime = $begin_time;
        }

        //计算天数
        $timediff = $endtime-$starttime;
        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $res = $days.'天'.$hours.'小时'.$mins.'分钟'.$secs.'秒';
        return $res;
    }
    
}
