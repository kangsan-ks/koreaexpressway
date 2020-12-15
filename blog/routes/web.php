<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Front@main');

Route::get('/news/press/list', 'Front@list');
Route::get('/news/event/list', 'Front@list');
Route::get('/news/startUp/list', 'Front@list');
Route::get('/library/article/list', 'Front@list');
Route::get('/library/report/list', 'Front@list');
Route::get('/library/video/list', 'Front@list');
Route::get('/aboutUs/gallery/list', 'Front@list');

Route::get('/news/press/view', 'Front@view');
Route::get('/news/event/view', 'Front@view');
Route::get('/news/startUp/view', 'Front@view');
Route::get('/library/article/view', 'Front@view');
Route::get('/library/report/view', 'Front@view');
Route::get('/library/video/view', 'Front@view');
Route::get('/about/gallery/view', 'Front@view');

Route::get('/project/all', 'Front@project');
Route::get('/project/sub01', 'Front@project');
Route::get('/project/sub02', 'Front@project');
Route::get('/project/sub03', 'Front@project');
Route::get('/project/sub04', 'Front@project');
Route::get('/aboutUs/business', 'Front@aboutUs');
Route::get('/aboutUs/organization', 'Front@organization');

Route::get('/search/page_search', 'Front@page_search');

Route::get('/as_admin/login', 'Back@as_login');
Route::post('/as_admin/login_action', 'Back@as_login_action');
Route::get('/as_admin/logout', 'Back@as_logout');

Route::get('/as_admin/message', 'Back@as_board_list');
Route::get('/as_admin/message/write_board_form', 'Back@write_board_form');
Route::post('/as_admin/message/write_board_action', 'Back@write_board_action');
Route::get('/as_admin/message/write_board_form/modify', 'Back@write_board_form');

Route::get('/as_admin/main_set', 'Back@main_set');
Route::post('/as_admin/change_main_set', 'Back@change_main_set');

Route::get('/as_admin/slide/list', 'Back@list');
Route::get('/as_admin/popup/list', 'Back@list');
Route::get('/as_admin/notice/list', 'Back@list');
Route::get('/as_admin/gallery/list', 'Back@list');
Route::get('/as_admin/member/list', 'Back@list');
Route::get('/as_admin/press/list', 'Back@list');
Route::get('/as_admin/event/list', 'Back@list');
Route::get('/as_admin/startUp/list', 'Back@list');
Route::get('/as_admin/article/list', 'Back@list');
Route::get('/as_admin/report/list', 'Back@list');
Route::get('/as_admin/video/list', 'Back@list');
Route::get('/as_admin/gallery/list', 'Back@list');

Route::get('/as_admin/slide/write', 'Back@write');
Route::get('/as_admin/popup/write', 'Back@write');
Route::get('/as_admin/notice/write', 'Back@write');
Route::get('/as_admin/gallery/write', 'Back@write');
Route::get('/as_admin/member/write', 'Back@write');
Route::get('/as_admin/gallery/write', 'Back@write');
Route::get('/as_admin/member/write', 'Back@write');
Route::get('/as_admin/press/write', 'Back@write');
Route::get('/as_admin/event/write', 'Back@write');
Route::get('/as_admin/startUp/write', 'Back@write');
Route::get('/as_admin/article/write', 'Back@write');
Route::get('/as_admin/report/write', 'Back@write');
Route::get('/as_admin/video/write', 'Back@write');
Route::get('/as_admin/gallery/write', 'Back@write');

Route::get('/as_admin/slide/modify', 'Back@write');
Route::get('/as_admin/popup/modify', 'Back@write');
Route::get('/as_admin/notice/modify', 'Back@write');
Route::get('/as_admin/gallery/modify', 'Back@write');
Route::get('/as_admin/member/modify', 'Back@write');
Route::get('/as_admin/gallery/modify', 'Back@write');
Route::get('/as_admin/member/modify', 'Back@write');
Route::get('/as_admin/press/modify', 'Back@write');
Route::get('/as_admin/event/modify', 'Back@write');
Route::get('/as_admin/startUp/modify', 'Back@write');
Route::get('/as_admin/article/modify', 'Back@write');
Route::get('/as_admin/report/modify', 'Back@write');
Route::get('/as_admin/video/modify', 'Back@write');
Route::get('/as_admin/gallery/modify', 'Back@write');

Route::post('/as_admin/slide/write_action', 'Back@write_action');
Route::post('/as_admin/popup/write_action', 'Back@write_action');
Route::post('/as_admin/notice/write_action', 'Back@write_action');
Route::post('/as_admin/gallery/write_action', 'Back@write_action');
Route::post('/as_admin/member/write_action', 'Back@write_action');
Route::post('/as_admin/gallery/write_action', 'Back@write_action');
Route::post('/as_admin/member/write_action', 'Back@write_action');
Route::post('/as_admin/press/write_action', 'Back@write_action');
Route::post('/as_admin/event/write_action', 'Back@write_action');
Route::post('/as_admin/startUp/write_action', 'Back@write_action');
Route::post('/as_admin/article/write_action', 'Back@write_action');
Route::post('/as_admin/report/write_action', 'Back@write_action');
Route::post('/as_admin/video/write_action', 'Back@write_action');
Route::post('/as_admin/gallery/write_action', 'Back@write_action');

Route::post('/as_admin/slide/control', 'Back@delete_action');
Route::post('/as_admin/popup/control', 'Back@delete_action');
Route::post('/as_admin/notice/control', 'Back@delete_action');
Route::post('/as_admin/gallery/control', 'Back@delete_action');
Route::post('/as_admin/member/control', 'Back@delete_action');