<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return redirect('/login');
});
//上传图片
Route::post('/uploadimg','HomeController@uploadimg');
/*
 * 普通用户
 */
Route::group(['middleware' => ['auth']], function () {
//参与到的产品列表
    Route::get('/{id}/list/product', 'HomeController@list_product')->name('user.list.product');
//参与到的项目列表
    Route::get('/{id}/list/project', 'HomeController@list_project')->name('user.list.project');
//登录用户默认主页
    Route::get('/home', 'HomeController@index');
//用户个人主页
    Route::get('/userInfo/{id}', 'HomeController@userInfo')->name('users.info');
//用户基本信息修改页
    Route::get('/userInfo/edit/{id}', 'HomeController@userEdit')->name('users.edit');
    Route::post('/userInfo/edit/{id}', 'HomeController@userUpdate');
//公告详情
    Route::get('article_gonggao/{id}', 'HomeController@article_gonggao')->name('article.gonggao');
//添加公告评论
    Route::post('/api/add_gonggao_comment/{id}', 'HomeController@add_gonggao_comment');
//公告下点赞
    Route::post('/api/gonggao/dianzan/{id}', 'HomeController@dianzan_gonggao');
    //产品管理
    Route::resource('products', 'productsController');
    //项目管理
    Route::resource('projects', 'projectController');

    Route::group(['middleware' => ['admin']], function () {
        //团队成员项目金额及工资查询
        Route::get('project_price','HomeController@project_price')->name('user.project.index');
    //即时获取除管理员外所有的用户
            Route::post('/api/userAll', 'HomeController@userAll');
    //产品转化为项目
            Route::post('/product_to_project', 'HomeController@product_to_project');
    //快速更新项目状态
            Route::post('/update_project_state', 'HomeController@update_project_state');
    //保存产品信息
            Route::post('/save_product', 'HomeController@save_product');
    //组织管理下职位列表页面
            Route::get('userManages/jobsIndex', 'UserManageController@jobsIndex')->name('usermanage.job.index');
    //组织管理下职位添加页面
            Route::get('userManages/jobsAdd', 'UserManageController@jobsAdd')->name('usermanage.job.add');
    //职位添加接口
            Route::post('/api/userManages/job/add', 'UserManageController@jobsAddApi');
    //职位删除接口
            Route::post('/api/userManages/job/{id}/del', 'UserManageController@jobsDelApi');
    //职位编辑接口
            Route::post('/api/userManages/job/{id}/edit', 'UserManageController@jobsEditApi');
    //组织管理下公告列表页面
            Route::get('userManages/gonggaoIndex', 'UserManageController@gonggaoIndex')->name('usermanage.gonggao.index');
    //组织管理下公告添加页面
            Route::get('userManages/gonggaoAdd', 'UserManageController@gonggaoAdd')->name('usermanage.gonggao.add');
    //公告添加接口
            Route::post('/api/userManages/gonggao/add', 'UserManageController@gonggaoAddApi');
    //公告删除接口
            Route::post('/api/userManages/gonggao/{id}/del', 'UserManageController@gonggaoDelApi');
    //组织管理
            Route::resource('userManages', 'UserManageController');
    //产品分类管理
            Route::resource('productcats', 'productcatsController');
    //产品下团队管理
            Route::get('products/{id}/team', 'productsController@teamIndex')->name('products.team');
    //产品下团队添加成员页面
            Route::get('products/{id}/team/add', 'productsController@teamAdd')->name('products.team.add');
    //产品下团队添加成员接口
            Route::post('/api/products/{id}/team/add', 'productsController@teamAddApi');
    //产品下团队删除成员接口
            Route::post('/api/products/{id}/team/del', 'productsController@teamDelApi');
    //产品下团队编辑成员接口
            Route::post('/api/products/{id}/team/edit', 'productsController@teamEditApi');
    //项目下团队管理
            Route::get('projects/{id}/team', 'projectController@teamIndex')->name('projects.team');
    //项目下团队添加成员页面
            Route::get('projects/{id}/team/add', 'projectController@teamAdd')->name('projects.team.add');
    //项目下团队添加成员接口
            Route::post('/api/projects/{id}/team/add', 'projectController@teamAddApi');
    //项目下团队删除成员接口
            Route::post('/api/projects/{id}/team/del', 'projectController@teamDelApi');
        //项目下团队编辑成员接口
        Route::post('/api/projects/{id}/team/edit', 'projectController@teamEditApi');
    //项目规则
            Route::resource('projectRules', 'project_rulesController');
        });
});

