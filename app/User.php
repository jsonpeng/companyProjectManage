<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Models\project_rules;
use App\Models\project;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin','type','birthday','gender','wechat','qq','tel','wages','head_img'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /*
      * 参与到的产品开发
     */
    public function products(){
        return $this->belongsToMany('App\Models\products','product_user','user_id','product_id')->withPivot('created_at', 'prop');
    }

    /*
     * 所参与到的项目开发
     */
    public function projects(){
        return $this->belongsToMany('App\Models\project','project_user','user_id','project_id')->withPivot('created_at', 'prop');
    }


    //项目奖金另一种算法
    public function getprojectprice2Attribute(){
        $project= project::where('created_at', '>', Carbon::today()->startOfMonth())->whereHas('users', function ($q) {
            $q->where('id',$this->id);
        });

    }

    //个人项目奖金
    public function getprojectpriceAttribute(){
        $date=Carbon::today()->startOfMonth()->format('Y-m-d');
        $start_date=Carbon::createFromFormat('Y-m-d', $date)->startOfMonth()->setTime(0, 0, 0);
        $end_date=Carbon::createFromFormat('Y-m-d', $date)->endOfMonth()->setTime(0, 0, 0);
        $projects=  $this->projects()->whereBetween('basic_time',[$start_date,$end_date])->where('status','结束')->get();

        $rules=project_rules::find(1);
        //员工基本成本
        $basic_cost=$rules->basic_cost;
        //个人额外系数
        $man_add_prop=($this->wages+$basic_cost)*$rules->man_prop;
        //第一阶段金额
        $first_price=$rules->first_price;
        //第一阶段比例
        $first_prop=$rules->first_prop;
        //第二阶段比例
        $second_prop=$rules->second_prop;
        //项目金额
        $project_price=0;

        if(count($projects)>0){
            foreach ($projects as $project){
                $project_price += ($project->price)*($project->users()->find($this->id)->pivot->prop)*(0.01);
            }
            //x=减去基本工资和成本后的金额
            $x=$project_price-($this->wages+$basic_cost);

            //只有减去后的金额大于0才能转换为第一阶段的比例
            if($x>0){
                //大于第一阶段金额
                if($x>$first_price){
                    return $man_add_prop+$first_price*$first_prop+($x-$first_price)*$second_prop;
                }else{
                    return $man_add_prop+$x*$first_prop;
                }
            }else{
                return $project_price*$rules->man_prop;
            }
        }else{
            return 0;
        }

    }


}
