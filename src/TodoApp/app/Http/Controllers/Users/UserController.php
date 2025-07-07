<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\RegisterRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
     * ユーザー登録ページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showRegisterPage()
    {
        return view('user.register');
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
        dd($validated_data);
        
        $result = $this->userService->registerNewUser($validated_data);
        
        if ($result) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
}