<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\RegisterRequest;
use App\Services\User\UserService;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\SentPasswordEmailRequest;
use App\Http\Requests\User\UpdateProfileRequest;

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
     * @param string $user_token
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
     * メールアドレス変更完了ページの表示
     * 
     * @param string $user_token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showProfileCompletePage($user_token)
    {
        $result = $this->userService->updateEmail($user_token);

        if ($result['result']) {
            return redirect()->route('user.profile')->with('success', 'プロフィールの変更に成功');
        } else {
            return redirect()->route('user.profile')->with('error', $result['message'] ?? 'プロフィールの変更に失敗');
        }
    }

    /**
     * ログインページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginPage()
    {
        // 既にログインしている場合はホームへリダイレクト
        if (auth()->check()) {
            return redirect()->route('home')->with('info', 'ログイン済みです');
        }
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
     * ユーザープロフィールページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showProfilePage()
    {
        $user = auth()->user();
        return view('user.profile', $user);
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

    /**
     * ユーザープロフィール更新
     * 
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $validated_data = $request->validated();

        $user = auth()->user();
        $result = $this->userService->updateProfile($user, $validated_data);

        if ($result['result']) {
            if ($result['message']) {
                return redirect()->back()->with('warning', $result['message']);
            }
            return redirect()->route('user.profile')->with('success', 'プロフィール更新に成功');
        } else {
            return redirect()->back()->with('error', $result['messeage'] ?? 'プロフィール更新に失敗');
        }
    }
}