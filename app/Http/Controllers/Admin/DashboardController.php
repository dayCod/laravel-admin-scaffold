<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class DashboardController extends Controller
{
    /**
     * Display the admin dashboard view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('admin.index');
    }

    /**
     * Display the admin user's profile view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function profile(): View
    {
        $user = Auth::user();

        return view('admin.profile', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitProfile(ProfileRequest $request): RedirectResponse
    {
        $user = User::find(Auth::id());
        $user->update($request->validated());

        return redirect()
            ->back()
            ->with('toastSuccess', 'Profile updated successfully.');
    }
}
