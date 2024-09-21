<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Utilities;

use App\Actions\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utilities\RolePermission\CreateRolePermissionRequest;
use App\Http\Requests\Utilities\RolePermission\UpdateRolePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class RolePermissionController extends Controller
{
    /**
     * Constructs a new instance of the RolePermissionController class.
     *
     * @param ActivityLogger $activityLogger The activity logger instance to use for logging actions.
     */
    public function __construct(
        protected ActivityLogger $activityLogger,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $roles = Role::withCount('permissions')
            ->where('name', '!=', 'admin')
            ->get();

        return view('admin.utilities.role-permission.index', compact('roles'));
    }

    /**
     * Display the form to create a new role permission.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $permissions = Permission::orderBy('name','asc')->get();

        return view('admin.utilities.role-permission.form', compact('permissions'));
    }

    /**
     * Store a newly created role permission in storage.
     *
     * @param \App\Http\Requests\Utilities\RolePermission\CreateRolePermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRolePermissionRequest $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);

        $this->activityLogger->recordLogger(action: 'create', prop: 'Role Permision');

        return redirect()
            ->route('admin.utilities.rolepermission.index')
            ->with('toastSuccess', 'Role Permission Created Successfully');
    }

    /**
     * Display the form to show an existing role permission.
     *
     * @param string $id The ID of the role permission to edit.
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('name','asc')->get();

        return view('admin.utilities.role-permission.show', compact('role', 'permissions'));
    }

    /**
     * Display the form to edit an existing role permission.
     *
     * @param string $id The ID of the role permission to edit.
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id): View
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('name','asc')->get();

        return view('admin.utilities.role-permission.form', compact('role', 'permissions'));
    }

    /**
     * Update an existing role permission.
     *
     * @param \App\Http\Requests\Utilities\RolePermission\UpdateRolePermissionRequest $request The request containing the updated role permission data.
     * @param string $id The ID of the role permission to update.
     * @return \Illuminate\Http\RedirectResponse A redirect response after the role permission has been updated.
     */
    public function update(UpdateRolePermissionRequest $request, string $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);

        $this->activityLogger->recordLogger(action: 'update', prop: 'Role Permision');

        return redirect()
            ->route('admin.utilities.rolepermission.index')
            ->with('toastSuccess', 'Role Permission Updated Successfully');
    }

    /**
     * Delete a role permission.
     *
     * @param string $id The ID of the role permission to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $id): JsonResponse
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissionsId = $role->permissions()->get()->pluck('id')->toArray();
        $role->permissions()->detach($permissionsId);
        $role->delete();

        $this->activityLogger->recordLogger(action: 'delete', prop: 'Role Permision');

        return response()->json(['success' => true], 200);
    }
}
