<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//login/register routes
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage') ;
Route::get('RegisterPage',[AuthController::class,'RegisterPage'])->name('auth#registerPage') ;



Route::middleware([
    'auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
      
      //dashboard
      Route::get('/dashboard', [AuthController::class,'dashboard'])->name('dashboard');
      
        //admin
        // categories routes
    Route::group(['prefix'=>'category','middleware' =>'admin_auth'],function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list') ;
});
    
    //users routes
    //home
    Route::group(['prefix'=>'user','middleware' =>'user_auth'],function(){
        Route::get('home',function(){
            return view('user.home');
        })->name('user#home') ;
   
});
});