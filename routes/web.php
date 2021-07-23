<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameUserController;
use App\Http\Controllers\AdminSportController;
use App\Http\Controllers\AdminGameController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\AdminAnswerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserPointsController;
use App\Http\Controllers\LeaderBoardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPrizeController;
use App\Http\Controllers\PrizesController;
use App\Http\Controllers\PaymentController;

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
Route::get('/completed', [GameUserController::class, 'completed'])->name('user.completed');
Route::get('/user/leaderboard/{id?}', [LeaderBoardController::class, 'index'])->name('user.leaderboard');
Route::get('/user/leaderboard/show/{id}/{period}', [LeaderBoardController::class, 'show'])->name('user.leaderboard.show');
Route::get('/profile/{user_id?}', [ProfileController::class, 'index'])->name('profile');
Route::post('/gameuser/store', [GameUserController::class, 'store'])->name('gameuser.store');
Route::post('/gameuser/login', [GameUserController::class, 'login'])->name('gameuser.login');
Route::post('/admin/sport/store', [AdminSportController::class, 'store'])->name('admin.sport.store');
Route::get('/admin', [AdminSportController::class, 'index'])->name('admin');
Route::post('/admin/login', [AdminUserController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminUserController::class, 'logout'])->name('admin.logout');
Route::post('/admin/sport/index', [AdminSportController::class, 'store'])->name('admin.sport.index');
Route::delete('/admin/sport/delete', [AdminSportController::class, 'delete'])->name('admin.sport.delete');
Route::post('/admin/sport/update', [AdminSportController::class, 'update'])->name('admin.sport.update');
Route::post('/admin/prize/update', [AdminPrizeController::class, 'update'])->name('admin.prize.update');
Route::post('/admin/game/store', [AdminGameController::class, 'store'])->name('admin.game.store');
Route::get('/admin/game/index/{id}', [AdminGameController::class, 'index'])->name('admin.game.index');
Route::delete('/admin/game/delete', [AdminGameController::class, 'delete'])->name('admin.game.delete');
Route::post('/admin/game/update', [AdminGameController::class, 'update'])->name('admin.game.update');
Route::get('/admin/questions/index/{id}', [AdminQuestionController::class, 'index'])->name('admin.questions.index');
Route::post('/admin/questions/store', [AdminQuestionController::class, 'store'])->name('admin.questions.store');
Route::delete('/admin/question/delete', [AdminQuestionController::class, 'delete'])->name('admin.question.delete');
Route::post('/admin/question/update', [AdminQuestionController::class, 'update'])->name('admin.question.update');
Route::get('/admin/answers/index/{id}', [AdminAnswerController::class, 'index'])->name('admin.answers.index');
Route::post('/admin/answers/store', [AdminAnswerController::class, 'store'])->name('admin.answers.store');
Route::post('/admin/answer/update', [AdminAnswerController::class, 'update'])->name('admin.answer.update');
Route::delete('/admin/answer/delete', [AdminAnswerController::class, 'delete'])->name('admin.answer.delete');

Route::get('/prizes', [PrizesController::class, 'index'])->name('prizes');
Route::get('/prizes/filter/{sport_id}/{rank_id}', [PrizesController::class, 'filter'])->name('prizes.filter');
Route::get("/payments/all", [PaymentController::class, 'payments'])->name('payments.view');
Route::get('/{id?}', [HomeController::class, 'index'])->name('home');
Route::get('/home/logout', [HomeController::class, 'logout'])->name('home.logout');
Route::get('/{sport_id}/{game_id}', [GameController::class, 'index'])->name('game');
Route::post('/userpoints/store', [UserPointsController::class, 'store'])->name('userpoints.store');
Route::post('/payments/initiate', [PaymentController::class, 'createSession'])->name('payments.initiate');
Route::get("/admin/users/download", [AdminUserController::class, 'exportUsers'])->name('admin.users.download');