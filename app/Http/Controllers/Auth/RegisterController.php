<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Contracts\Roles;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\RegisterRequest;

final class RegisterController extends Controller
{
    /**
     * Render the view for the user registration page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registerView(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the user registration form submission.
     *
     * This method creates a new user account with the provided information from the
     * RegisterRequest, sets the email_verified_at timestamp, and assigns the STAFF
     * role to the user. It then redirects the user to the login page.
     *
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerAction(RegisterRequest $request): RedirectResponse
    {
        $user = User::create($request->validated() + [
            'email_verified_at' => now(),
        ]);

        $user->assignRole(Roles::STAFF);

        return redirect()
            ->route('auth.login.view')
            ->with('toastSuccess', 'User registered successfully.');
    }
}
