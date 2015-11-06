<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

Route::post('admin/settings/store', [
    'uses' => 'Ofat\DbConfigAdmin\AdminController@store',
    'as' => 'dbConfigAdmin.store'
]);

Route::get('admin/settings/logs', [
    'uses' => 'Ofat\DbConfigAdmin\AdminController@logs',
    'as' => 'dbConfigAdmin.logs'
]);

Route::get('admin/settings/{page}', [
    'uses' => 'Ofat\DbConfigAdmin\AdminController@manage',
    'as' => 'dbConfigAdmin.manage'
]);