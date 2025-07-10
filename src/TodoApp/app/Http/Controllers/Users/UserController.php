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
     * ユーザー仮登録ページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showRegisterPage()
    {
        return view('user.register');
    }

    /**
     * ユーザー登録完了ページの表示
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showRegisterCompletePage($user_token)
    {
        $result = $this->userService->registerNewUser($user_token);

        if ($result['result']) {
            return redirect()->route('user.login')->with('success', 'ユーザーの登録に成功');
        } else {
            return redirect()->back()->with('error', $result['message'] ?? 'ユーザーの登録に失敗');
        }
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
     * ユーザー登録の仮登録処理
     * 
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function preRegisterNewUser(RegisterRequest $request)
    {
        $validated_data = $request->validated();

        // ユーザーの仮登録処理        
        $result = $this->userService->preRegisterNewUser($validated_data);

        if ($result['result']) {
            return redirect()->route('user.login')->with('success', '仮登録メールの送信に成功');
        } else {
            return redirect()->back()->with('error', $result['message'] ?? '仮登録メールの送信に失敗');
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
            return redirect()->route('home')->with('success', 'ユーザーのログインに成功');
        } else {
            return redirect()->back()->with('error', 'ユーザーのログインに失敗');
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
            return redirect()->route('user.login')->with('success', 'ユーザーのログアウトに成功');
        } else {
            return redirect()->route('home')->with('error', 'ユーザーのログアウトに失敗');
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
            return redirect()->route('user.login')->with('success', 'パスワードリセットメールの送信に成功');
        } else {
            return redirect()->route('password.email')->with('error', 'パスワードリセットメールの送信に失敗');
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
            return redirect()->route('user.login')->with('success', 'パスワードリセットに成功');
        } else {
            return redirect()->back()->with('error', 'パスワードリセットに失敗');
        }
    }
}