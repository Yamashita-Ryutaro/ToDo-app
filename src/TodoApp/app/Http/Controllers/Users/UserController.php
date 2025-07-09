<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\RegisterRequest;
use App\Services\User\UserService;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\SentPasswordEmailRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * ユーザー登録ページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showRegisterPage()
    {
        return view('user.register');
    }

    /**
     * ログインページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('user.login');
    }

    /**
     * パスワードリセットメールページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showPasswordEmailPage()
    {
        return view('password.email');
    }

    /**
     * パスワードリセットページの表示
     * 
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function showPasswordUpdatePage($token)
    {
        return view('password.reset', ['token' => $token]);
    }

    /**
     * ユーザー登録の処理
     * 
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerNewUser(RegisterRequest $request)
    {
        $validated_data = $request->validated();
        
        $result = $this->userService->registerNewUser($validated_data);
        
        if ($result) {
            return redirect()->route('user.login');
        } else {
            return redirect()->back();
        }
    }

    /**
     * ユーザーログインの処理
     * 
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginUser(LoginRequest $request)
    {
        $validated_data = $request->validated();

        $result = $this->userService->loginUser($validated_data);
        
        if ($result) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }

    /**
     * ユーザーログアウト処理
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutUser()
    {
        $result = $this->userService->logoutUser();
        if ($result) {
            return redirect()->route('user.login');
        } else {
            return redirect()->back();
        }
    }

    /**
     * パスワードリセットメール送信
     * 
     * @param SentPasswordEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sentPasswordEmail(SentPasswordEmailRequest $request)
    {
        $validated_data = $request->validated();
        $result = $this->userService->sentPasswordEmail($validated_data);

        if ($result) {
            return redirect()->route('user.login');
        } else {
            return redirect()->back();
        }
    }

    /**
     * パスワードリセット
     * 
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ResetPasswordRequest $request)
    {
        $validated_data = $request->validated();
        $result = $this->userService->resetPassword($validated_data);

        if ($result) {
            return redirect()->route('user.login');
        } else {
            return redirect()->back();
        }
    }
}