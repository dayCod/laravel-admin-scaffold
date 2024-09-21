<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\ActivityLog;
use App\Models\Permission;
use App\Models\VisitorCounter;
use Illuminate\Http\RedirectResponse;

final class DashboardController extends Controller
{
    /**
     * Display the admin dashboard view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        $totalUsers = User::whereHas('roles', fn ($q) => $q->where('name', '!=', 'admin'))->count();
        $totalDailyActivities = ActivityLog::whereDate('created_at', now()->today())->count();
        $totalDailyVisitors = VisitorCounter::whereDate('created_at', now()->today())->count();

        return view('admin.index', [
            'totalRoles' => $totalRoles,
            'totalPermissions' => $totalPermissions,
            'totalUsers' => $totalUsers,
            'totalDailyActivities' => $totalDailyActivities,
            'totalDailyVisitors' => $totalDailyVisitors,
        ]);
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
