<?php
use App\User;
use App\Models\project_rules;
use App\Models\project;
use Carbon\Carbon;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5
 * Time: 11:39
 */

//管理员结算
function get_project_by_pra($users,$date){
    if($date==''){
        $date=Carbon::today()->startOfMonth()->format('Y-m-d');
    }else {
        $date = $date.'-01';
    }
    //return $date;
    $start_date=$date;
    $end_date=Carbon::createFromFormat('Y-m-d', $date)->endOfMonth()->setTime(0, 0, 0);

    $projects=$users->projects()->whereBetween('basic_time',[$start_date,$end_date])->where('status','结束')->get();
        if(!empty($projects)) {
            return $projects;
        }else{
            return '--';
        }

}
//用户个人看
function get_project_by_user($users,$date){
    if($date==''){
        $date=Carbon::today()->startOfMonth()->format('Y-m-d');
    }else {
        $date = $date.'-01';
    }
    //return $date;
    $start_date=$date;
    $end_date=Carbon::createFromFormat('Y-m-d', $date)->endOfMonth()->setTime(0, 0, 0);

    $projects=$users->projects()->where('start_time','>=',$start_date)->where('end_time','<=',$end_date)->get();
    if(!empty($projects)) {
        return $projects;
    }else{
        return '--';
    }
}





//通过时间段获取到对应的项目金额
function get_project_price_by_pra($users,$date){
    if($date==''){
        $date=Carbon::today()->startOfMonth()->format('Y-m-d');
    }else {
        $date = $date.'-01';
    }
    $start_date=Carbon::createFromFormat('Y-m-d', $date)->startOfMonth()->setTime(0, 0, 0);
    $end_date=Carbon::createFromFormat('Y-m-d', $date)->endOfMonth()->setTime(0, 0, 0);

    $projects=  $users->projects()->whereBetween('basic_time',[$start_date,$end_date])->where('status','结束')->get();
    $rules=project_rules::find(1);
    //员工基本成本
    $basic_cost=$rules->basic_cost;
    //个人额外系数
    $man_add_prop=($users->wages+$basic_cost)*$rules->man_prop;
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
            $project_price += ($project->price)*($project->users()->find($users->id)->pivot->prop)*(0.01);
        }
        //x=减去基本工资和成本后的金额
        $x=$project_price-($users->wages+$basic_cost);

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