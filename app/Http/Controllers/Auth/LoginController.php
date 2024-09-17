<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LoginController extends Controller
{
    /**
     * Renders the login view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function loginView(): View
    {
        return view('auth.login');
    }

    /**
     * Handles the login action for the application.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAction(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with('toastSuccess', 'You have successfully logged in.');
        }

        return redirect()
            ->back()
            ->with('toastError', 'Email/password is incorrect.');
    }
}
