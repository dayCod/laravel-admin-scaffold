<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Utilities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Utilities\UserRole\CreateUserRoleRequest;
use App\Http\Requests\Utilities\UserRole\UpdateUserRoleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class UserRoleController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')
            ->whereHas('roles', fn ($q) => $q->where('name', '!=', 'admin'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.utilities.user-role.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::orderBy('name', 'asc')
            ->where('name', '!=', 'admin')
            ->get();

        return view('admin.utilities.user-role.form', compact('roles'));
    }

    public function store(CreateUserRoleRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->syncRoles(array($request->role_id));

        return redirect()
            ->route('admin.utilities.userrole.index')
            ->with('toastSuccess', 'User Role Successfully created!');
    }

    public function show(string $id): View
    {
        $user = User::with('roles')->findOrFail($id);

        return view('admin.utilities.user-role.show', compact('user'));
    }

    public function edit(string $id): View
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::orderBy('name', 'asc')
            ->where('name', '!=', 'admin')
            ->get();

        return view('admin.utilities.user-role.form', compact('user', 'roles'));
    }

    public function update(UpdateUserRoleRequest $request, string $id): RedirectResponse
    {
        $user = User::with('roles')->findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->syncRoles(array($request->role_id));

        return redirect()
            ->route('admin.utilities.userrole.index')
            ->with('toastSuccess', 'User Role successfully updated!');
    }

    public function delete(string $id): JsonResponse
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = $user->roles()->get()->pluck('id')->toArray();
        $user->roles()->detach($roles);
        $user->delete();

        return response()->json(['success' => true], 200);
    }
}
