<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\job_type;
use App\Models\project_rules;
use App\Models\productcats;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        job_type::insert([
            'name'=>'系统管理员',
            'desc'=>'负责系统管理'
        ]);
        User::insert([
            'name'=>'zcjy',
            'email'=>'admin@zcjy.com',
            'password'=>bcrypt('zcjy123456*'),
            'is_admin'=>'是',
            'type'=>'系统管理员',
            'head_img'=>'/images/logo-min.png',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'wages'=>'5000'
        ]);
        productcats::insert([
            'name'=>'基础网站建设',
            'des'=>'基础的网站设计'
        ]);
        productcats::insert([
                'name'=>'定制网站设计',
                'des'=>'定制化网站设计,包括加入一些自定义的功能及定制化'
        ]);
        project_rules::insert([
            'basic_cost'=>1000,
            'first_price'=>5000,
            'first_prop'=>0.2,
            'second_prop'=>0.4,
            'man_prop'=>0.1,
        ]);
    }
}
