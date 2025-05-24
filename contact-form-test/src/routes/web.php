<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\ModalController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//問い合わせフォーム画面表示
Route::get('/', [ContactController::class, 'contact']);
// 修正ボタン用（戻る用）
Route::post('/', [ContactController::class, 'back']);
//入力事項確認画面の表示
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
//
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);



//新規登録画面
Route::get('/register', [AdminRegisterController::class, 'show'])->name('register');
Route::post('/register', [AdminRegisterController::class, 'register']);

//ログイン
Route::get('/login', [AdminRegisterController::class, 'login'])->name('admin.admin');
Route::post('/login', [CustomAuthenticatedSessionController::class, 'store'])->name('login');
//ログアウト
Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');
//検索


// 管理画面：一覧と検索（GET /admin）
Route::middleware('auth')->get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

Route::get('admin/export',[AdminController::class,'export'])->middleware('auth')->name('admin.export');