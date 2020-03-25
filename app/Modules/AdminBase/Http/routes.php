<?php

/*
|--------------------------------------------------------------------------
|
| 统一命名空间 Admin
| 统一前缀 admin
| 用户认证统一使用 auth 中间件
| 权限认证统一使用 permission:权限名称
|
|--------------------------------------------------------------------------
*/

use App\Models\AdminBase\Permission;

/*
|--------------------------------------------------------------------------
| 用户登录、退出、更改密码
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin/user', 'as' => 'admin.'], function () {
    //用户管理
    Route::group(['as' => 'user.'], function () {
        //登录
        Route::get('login', ['as' => 'loginForm', 'uses' => 'UserController@showLoginForm']);
        Route::post('login', ['as' => 'login', 'uses' => 'UserController@login']);
        //退出
        Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@logout', 'middleware' => 'auth']);
        //更改密码
        Route::get('change_my_password_form', ['as' => 'changeMyPasswordForm', 'uses' => 'UserController@changeMyPasswordForm', 'middleware' => 'auth']);
        Route::post('change_my_password', ['as' => 'changeMyPassword', 'uses' => 'UserController@changeMyPassword', 'middleware' => 'auth']);
    });
});

/*
|--------------------------------------------------------------------------
| 后台公共页面
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    //后台布局
    Route::get('/', ['as' => 'layout', 'uses' => 'IndexController@layout']);
    //后台首页
    Route::get('/index', ['as' => 'index', 'uses' => 'IndexController@index']);
});

/*
|--------------------------------------------------------------------------
| 系统用户模块
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'permission:' . Permission::MODULE_USER]], function () {
    //用户管理
    Route::group(['middleware' => 'permission:' . Permission::USER], function () {
        Route::get('user', ['as' => 'user', 'uses' => 'UserController@index']);
    });
    Route::group(['as' => 'user.', 'middleware' => 'permission:' . Permission::USER], function () {
        Route::get('user/data', ['as' => 'data', 'uses' => 'UserController@data']);
        //添加
        Route::group(['middleware' => 'permission:' . Permission::USER_CREATE], function () {
            Route::get('user/create', ['as' => 'create', 'uses' => 'UserController@create']);
            Route::post('user/store', ['as' => 'store', 'uses' => 'UserController@store']);
        });
        //编辑
        Route::group(['middleware' => 'permission:' . Permission::USER_EDIT], function () {
            Route::get('user/{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
            Route::put('user/{id}/update', ['as' => 'update', 'uses' => 'UserController@update']);
        });
        //删除
        Route::group(['middleware' => 'permission:' . Permission::USER_DESTROY], function () {
            Route::delete('user/destroy', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
        });
        //分配角色
        Route::group(['middleware' => 'permission:' . Permission::USER_ROLE], function () {
            Route::get('user/{id}/role', ['as' => 'role', 'uses' => 'UserController@role']);
            Route::put('user/{id}/assignRole', ['as' => 'assignRole', 'uses' => 'UserController@assignRole']);
        });
        //分配权限
        Route::group(['middleware' => 'permission:' . Permission::USER_PERMISSION], function () {
            Route::get('user/{id}/permission', ['as' => 'permission', 'uses' => 'UserController@permission']);
            Route::put('user/{id}/assignPermission', ['as' => 'assignPermission', 'uses' => 'UserController@assignPermission']);
        });
    });

    //角色管理
    Route::group(['middleware' => 'permission:' . Permission::ROLE], function () {
        Route::get('role', ['as' => 'role', 'uses' => 'RoleController@index']);
    });
    Route::group(['as' => 'role.', 'middleware' => 'permission:' . Permission::ROLE], function () {
        Route::get('role/data', ['as' => 'data', 'uses' => 'RoleController@data']);
        //添加
        Route::group(['middleware' => 'permission:' . Permission::ROLE_CREATE], function () {
            Route::get('role/create', ['as' => 'create', 'uses' => 'RoleController@create']);
            Route::post('role/store', ['as' => 'store', 'uses' => 'RoleController@store']);
        });
        //编辑
        Route::group(['middleware' => 'permission:' . Permission::ROLE_EDIT], function () {
            Route::get('role/{id}/edit', ['as' => 'edit', 'uses' => 'RoleController@edit']);
            Route::put('role/{id}/update', ['as' => 'update', 'uses' => 'RoleController@update']);
        });
        //删除
        Route::group(['middleware' => 'permission:' . Permission::ROLE_DESTROY], function () {
            Route::delete('role/destroy', ['as' => 'destroy', 'uses' => 'RoleController@destroy']);
        });
        //分配权限
        Route::group(['middleware' => 'permission:' . Permission::ROLE_PERMISSION], function () {
            Route::get('role/{id}/permission', ['as' => 'permission', 'uses' => 'RoleController@permission']);
            Route::put('role/{id}/assignPermission', ['as' => 'assignPermission', 'uses' => 'RoleController@assignPermission']);
        });
    });

    //权限管理
    Route::group(['middleware' => 'permission:' . Permission::PERMISSION], function () {
        Route::get('permission', ['as' => 'permission', 'uses' => 'PermissionController@index']);
    });
    Route::group(['as' => 'permission.', 'middleware' => 'permission:' . Permission::PERMISSION], function () {
        Route::get('permission/data', ['as' => 'data', 'uses' => 'PermissionController@data']);
        //添加
        Route::group(['middleware' => 'permission:' . Permission::PERMISSION_CREATE], function () {
            Route::get('permission/create', ['as' => 'create', 'uses' => 'PermissionController@create']);
            Route::post('permission/store', ['as' => 'store', 'uses' => 'PermissionController@store']);
        });
        //编辑
        Route::group(['middleware' => 'permission:' . Permission::PERMISSION_EDIT], function () {
            Route::get('permission/{id}/edit', ['as' => 'edit', 'uses' => 'PermissionController@edit']);
            Route::put('permission/{id}/update', ['as' => 'update', 'uses' => 'PermissionController@update']);
        });
        //删除
        Route::group(['middleware' => 'permission:' . Permission::PERMISSION_DESTROY], function () {
            Route::delete('permission/destroy', ['as' => 'destroy', 'uses' => 'PermissionController@destroy']);
        });
    });
});

/*
|--------------------------------------------------------------------------
| 系统管理模块
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'permission:' . Permission::MODULE_SYSTEM]], function () {
    //配置组
    Route::group(['middleware' => 'permission:' . Permission::OPTION_GROUP], function () {
        Route::get('option_group', ['as' => 'option_group', 'uses' => 'OptionGroupController@index']);
    });
    Route::group(['as' => 'option_group.', 'middleware' => 'permission:' . Permission::OPTION_GROUP], function () {
        Route::get('option_group/data', ['as' => 'data', 'uses' => 'OptionGroupController@data']);
        //添加
        Route::group(['middleware' => 'permission:' . Permission::OPTION_GROUP_CREATE], function () {
            Route::get('option_group/create', ['as' => 'create', 'uses' => 'OptionGroupController@create']);
            Route::post('option_group/store', ['as' => 'store', 'uses' => 'OptionGroupController@store']);
        });
        //编辑
        Route::group(['middleware' => 'permission:' . Permission::OPTION_GROUP_EDIT], function () {
            Route::get('option_group/{id}/edit', ['as' => 'edit', 'uses' => 'OptionGroupController@edit']);
            Route::put('option_group/{id}/update', ['as' => 'update', 'uses' => 'OptionGroupController@update']);
        });
        //删除
        Route::group(['middleware' => 'permission:' . Permission::OPTION_GROUP_DESTROY], function () {
            Route::delete('option_group/destroy', ['as' => 'destroy', 'uses' => 'OptionGroupController@destroy']);
        });
    });

    //配置项
    Route::group(['middleware' => 'permission:' . Permission::OPTION], function () {
        Route::get('option', ['as' => 'option', 'uses' => 'OptionController@index']);
    });
    Route::group(['as' => 'option.', 'middleware' => 'permission:' . Permission::OPTION], function () {
        //添加
        Route::group(['middleware' => 'permission:' . Permission::OPTION_CREATE], function () {
            Route::get('option/create', ['as' => 'create', 'uses' => 'OptionController@create']);
            Route::post('option/store', ['as' => 'store', 'uses' => 'OptionController@store']);
        });
        //编辑
        Route::group(['middleware' => 'permission:' . Permission::OPTION_EDIT], function () {
            Route::put('option/update', ['as' => 'update', 'uses' => 'OptionController@update']);
        });
        //删除
        Route::group(['middleware' => 'permission:' . Permission::OPTION_DESTROY], function () {
            Route::delete('option/destroy', ['as' => 'destroy', 'uses' => 'OptionController@destroy']);
        });
        //配置项上传图片
        Route::group(['middleware' => 'permission:' . Permission::OPTION_CREATE], function () {
            Route::post('option/upload', ['as' => 'upload', 'uses' => 'OptionController@upload']);
        });
    });

    //登录日志
    Route::group(['middleware' => 'permission:' . Permission::LOGIN_LOG], function () {
        Route::get('login_log', ['as' => 'login_log', 'uses' => 'LoginLogController@index']);
    });
    Route::group(['as' => 'login_log.', 'middleware' => 'permission:' . Permission::LOGIN_LOG], function () {
        Route::get('login_log/data', ['as' => 'data', 'uses' => 'LoginLogController@data']);
        Route::delete('login_log/destroy', ['as' => 'destroy', 'uses' => 'LoginLogController@destroy']);
    });
});
