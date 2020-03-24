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
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'permission:user']], function () {
    //用户管理
    Route::get('user', ['as' => 'user', 'uses' => 'UserController@index', 'middleware' => 'permission:user.user']);
    Route::group(['as' => 'user.', 'middleware' => 'permission:user.user'], function () {
        Route::get('user/data', ['as' => 'data', 'uses' => 'UserController@data']);
        //添加
        Route::get('user/create', ['as' => 'create', 'uses' => 'UserController@create', 'middleware' => 'permission:user.user.create']);
        Route::post('user/store', ['as' => 'store', 'uses' => 'UserController@store', 'middleware' => 'permission:user.user.create']);
        //编辑
        Route::get('user/{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit', 'middleware' => 'permission:user.user.edit']);
        Route::put('user/{id}/update', ['as' => 'update', 'uses' => 'UserController@update', 'middleware' => 'permission:user.user.edit']);
        //删除
        Route::delete('user/destroy', ['as' => 'destroy', 'uses' => 'UserController@destroy', 'middleware' => 'permission:user.user.destroy']);
        //分配角色
        Route::get('user/{id}/role', ['as' => 'role', 'uses' => 'UserController@role', 'middleware' => 'permission:user.user.role']);
        Route::put('user/{id}/assignRole', ['as' => 'assignRole', 'uses' => 'UserController@assignRole', 'middleware' => 'permission:user.user.role']);
        //分配权限
        Route::get('user/{id}/permission', ['as' => 'permission', 'uses' => 'UserController@permission', 'middleware' => 'permission:user.user.permission']);
        Route::put('user/{id}/assignPermission', ['as' => 'assignPermission', 'uses' => 'UserController@assignPermission', 'middleware' => 'permission:user.user.permission']);
    });

    //角色管理
    Route::get('role', ['as' => 'role', 'uses' => 'RoleController@index', 'middleware' => 'permission:user.role']);
    Route::group(['as' => 'role.', 'middleware' => 'permission:user.role'], function () {
        Route::get('role/data', ['as' => 'data', 'uses' => 'RoleController@data']);
        //添加
        Route::get('role/create', ['as' => 'create', 'uses' => 'RoleController@create', 'middleware' => 'permission:user.role.create']);
        Route::post('role/store', ['as' => 'store', 'uses' => 'RoleController@store', 'middleware' => 'permission:user.role.create']);
        //编辑
        Route::get('role/{id}/edit', ['as' => 'edit', 'uses' => 'RoleController@edit', 'middleware' => 'permission:user.role.edit']);
        Route::put('role/{id}/update', ['as' => 'update', 'uses' => 'RoleController@update', 'middleware' => 'permission:user.role.edit']);
        //删除
        Route::delete('role/destroy', ['as' => 'destroy', 'uses' => 'RoleController@destroy', 'middleware' => 'permission:user.role.destroy']);
        //分配权限
        Route::get('role/{id}/permission', ['as' => 'permission', 'uses' => 'RoleController@permission', 'middleware' => 'permission:user.role.permission']);
        Route::put('role/{id}/assignPermission', ['as' => 'assignPermission', 'uses' => 'RoleController@assignPermission', 'middleware' => 'permission:user.role.permission']);
    });

    //权限管理
    Route::get('permission', ['as' => 'permission', 'uses' => 'PermissionController@index', 'middleware' => 'permission:user.permission']);
    Route::group(['as' => 'permission.', 'middleware' => 'permission:user.permission'], function () {
        Route::get('permission/data', ['as' => 'data', 'uses' => 'PermissionController@data']);
        //添加
        Route::get('permission/create', ['as' => 'create', 'uses' => 'PermissionController@create', 'middleware' => 'permission:user.permission.create']);
        Route::post('permission/store', ['as' => 'store', 'uses' => 'PermissionController@store', 'middleware' => 'permission:user.permission.create']);
        //编辑
        Route::get('permission/{id}/edit', ['as' => 'edit', 'uses' => 'PermissionController@edit', 'middleware' => 'permission:user.permission.edit']);
        Route::put('permission/{id}/update', ['as' => 'update', 'uses' => 'PermissionController@update', 'middleware' => 'permission:user.permission.edit']);
        //删除
        Route::delete('permission/destroy', ['as' => 'destroy', 'uses' => 'PermissionController@destroy', 'middleware' => 'permission:user.permission.destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| 系统管理模块
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'permission:system']], function () {
    //配置组
    Route::get('config_group', ['as' => 'config_group', 'uses' => 'ConfigGroupController@index', 'middleware' => 'permission:system.config_group']);
    Route::group(['as' => 'config_group.', 'middleware' => 'permission:system.config_group'], function () {
        Route::get('config_group/data', ['as' => 'data', 'uses' => 'ConfigGroupController@data']);
        //添加
        Route::get('config_group/create', ['as' => 'create', 'uses' => 'ConfigGroupController@create', 'middleware' => 'permission:system.config_group.create']);
        Route::post('config_group/store', ['as' => 'store', 'uses' => 'ConfigGroupController@store', 'middleware' => 'permission:system.config_group.create']);
        //编辑
        Route::get('config_group/{id}/edit', ['as' => 'edit', 'uses' => 'ConfigGroupController@edit', 'middleware' => 'permission:system.config_group.edit']);
        Route::put('config_group/{id}/update', ['as' => 'update', 'uses' => 'ConfigGroupController@update', 'middleware' => 'permission:system.config_group.edit']);
        //删除
        Route::delete('config_group/destroy', ['as' => 'destroy', 'uses' => 'ConfigGroupController@destroy', 'middleware' => 'permission:system.config_group.destroy']);
    });

    //配置项
    Route::get('configuration', ['as' => 'configuration', 'uses' => 'ConfigurationController@index', 'middleware' => 'permission:system.configuration']);
    Route::group(['as' => 'configuration.', 'middleware' => 'permission:system.configuration'], function () {
        //添加
        Route::get('configuration/create', ['as' => 'create', 'uses' => 'ConfigurationController@create', 'middleware' => 'permission:system.configuration.create']);
        Route::post('configuration/store', ['as' => 'store', 'uses' => 'ConfigurationController@store', 'middleware' => 'permission:system.configuration.create']);
        //编辑
        Route::put('configuration/update', ['as' => 'update', 'uses' => 'ConfigurationController@update', 'middleware' => 'permission:system.configuration.edit']);
        //删除
        Route::delete('configuration/destroy', ['as' => 'destroy', 'uses' => 'ConfigurationController@destroy', 'middleware' => 'permission:system.configuration.destroy']);
        //配置项上传图片
        Route::post('configuration/upload', ['as' => 'upload', 'uses' => 'ConfigurationController@upload', 'middleware' => 'permission:system.configuration.create']);
    });

    //登录日志
    Route::get('login_log', ['as' => 'login_log', 'uses' => 'LoginLogController@index', 'middleware' => 'permission:system.login_log']);
    Route::group(['as' => 'login_log.', 'middleware' => 'permission:system.login_log'], function () {
        Route::get('login_log/data', ['as' => 'data', 'uses' => 'LoginLogController@data']);
        Route::delete('login_log/destroy', ['as' => 'destroy', 'uses' => 'LoginLogController@destroy']);
    });

});
