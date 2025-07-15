<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
/* TaskControllerクラスを名前空間でインポートする */
/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/login", [UserController::class,"showLoginPage"])->name("user.login");
Route::post("/login", [UserController::class,"loginUser"]);
Route::get("/register", [UserController::class,"showRegisterPage"])->name("user.register");
Route::post("/register", [UserController::class,"preRegisterNewUser"]);
Route::get("/register/{user_token}", [UserController::class,"showRegisterCompletePage"])->name("user.register.complete");
Route::post("/logout", [UserController::class,"logoutUser"])->name("user.logout");
Route::get("/password/email", [UserController::class,"showPasswordEmailPage"])->name("password.email");
Route::post("/password/email", [UserController::class,"sentPasswordEmail"]);
Route::get("/password/reset/{token}", [UserController::class,"showPasswordUpdatePage"])->name("password.reset");
Route::post("/password/reset", [UserController::class,"updatePassword"])->name("password.update");

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get("/user/profile", [UserController::class,"showProfilePage"])->name("user.profile");
    Route::post("/user/profile", [UserController::class,"updateProfile"]);
});
Route::get("/user/profile/{user_token}", [UserController::class,"showProfileCompletePage"])->name("user.profile.complete");