<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/questions', QuestionsController::class)->except('show');
Route::get('/questions/{slug}', [QuestionsController::class,'show'])->name('questions.show');
Route::resource('questions.answers', AnswersController::class)->except(['create','show']);
Route::put('/questions/{question}/answers/{answer}/mark-as-best',[AnswersController::class,'markAsBest'])->name('questions.answers.markAsBest');

Route::post('/questions/{question}/mark-as-fav',[FavoritesController::class,'store'])->name('questions.mark-as-fav');
Route::delete('/questions/{question}/mark-as-unfav',[FavoritesController::class,'destroy'])->name('questions.mark-as-unfav');

Route::post('/questions/{question}/vote/{vote}',[VotesController::class,'voteQuestion'])->name('questions.vote');
