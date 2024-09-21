<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Utilities;

use App\Models\Role;
use App\Models\User;
use App\Actions\ActivityLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Utilities\UserRole\{CreateUserRoleRequest, UpdateUserRoleRequest};

final class UserRoleController extends Controller
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
     * Retrieves a list of users with their associated roles, excluding the 'admin' role, and orders them by creation date in descending order.
     *
     * @return \Illuminate\Contracts\View\View The view containing the list of users.
     */
    public function index(): View
    {
        $users = User::with('roles')
            ->whereHas('roles', fn ($q) => $q->where('name', '!=', 'admin'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.utilities.user-role.index', compact('users'));
    }

    /**
     * Retrieves a list of roles, excluding the 'admin' role, and orders them alphabetically by name.
     *
     * This method is used to populate the form for creating a new user role.
     *
     * @return \Illuminate\Contracts\View\View The view containing the list of roles.
     */
    public function create(): View
    {
        $roles = Role::orderBy('name', 'asc')
            ->where('name', '!=', 'admin')
            ->get();

        return view('admin.utilities.user-role.form', compact('roles'));
    }

    /**
     * Stores a new user role in the system.
     *
     * This method is used to create a new user with the specified name, email, and role. The user is then associated with the specified role using the `syncRoles` method.
     *
     * @param \App\Http\Requests\Utilities\UserRole\CreateUserRoleRequest $request The request containing the user and role data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the user role index page with a success message.
     */
    public function store(CreateUserRoleRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->syncRoles(array($request->role_id));

        $this->activityLogger->recordLogger(action: 'create', prop: 'User Role');

        return redirect()
            ->route('admin.utilities.userrole.index')
            ->with('toastSuccess', 'User Role Successfully created!');
    }

    /**
     * Retrieves a user with their associated roles and displays the user details.
     *
     * This method is used to show the details of a specific user, including their assigned roles.
     *
     * @param string $id The ID of the user to retrieve.
     * @return \Illuminate\Contracts\View\View The view containing the user details.
     */
    public function show(string $id): View
    {
        $user = User::with('roles')->findOrFail($id);

        return view('admin.utilities.user-role.show', compact('user'));
    }

    /**
     * Retrieves a user with their associated roles and displays the user details in the edit form.
     *
     * This method is used to show the edit form for a specific user, including their assigned roles. The user and available roles are passed to the view for rendering the form.
     *
     * @param string $id The ID of the user to retrieve.
     * @return \Illuminate\Contracts\View\View The view containing the user details and roles for the edit form.
     */
    public function edit(string $id): View
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::orderBy('name', 'asc')
            ->where('name', '!=', 'admin')
            ->get();

        return view('admin.utilities.user-role.form', compact('user', 'roles'));
    }

    /**
     * Updates the details of a user, including their assigned role.
     *
     * This method is used to update the name, email, and role of a specific user. It retrieves the user with their associated roles, updates the user details, and then synchronizes the user's roles with the provided role ID.
     *
     * @param \App\Http\Requests\Utilities\UserRole\UpdateUserRoleRequest $request The request containing the updated user details.
     * @param string $id The ID of the user to update.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the user role index page with a success message.
     */
    public function update(UpdateUserRoleRequest $request, string $id): RedirectResponse
    {
        $user = User::with('roles')->findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->syncRoles(array($request->role_id));

        $this->activityLogger->recordLogger(action: 'update', prop: 'User Role');

        return redirect()
            ->route('admin.utilities.userrole.index')
            ->with('toastSuccess', 'User Role successfully updated!');
    }

    /**
     * Deletes a user and detaches all their associated roles.
     *
     * This method is used to delete a specific user from the system, along with detaching all the roles that were assigned to the user. It first retrieves the user with their associated roles, then detaches the roles, and finally deletes the user.
     *
     * @param string $id The ID of the user to delete.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the success of the delete operation.
     */
    public function delete(string $id): JsonResponse
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = $user->roles()->get()->pluck('id')->toArray();
        $user->roles()->detach($roles);
        $user->delete();

        $this->activityLogger->recordLogger(action: 'delete', prop: 'User Role');

        return response()->json(['success' => true], 200);
    }
}
