<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {

        abort_unless(
            auth()->user()->can('view users'),
            403
        );

        $query = User::query()
            ->with('roles');

        if ($request->filled('search')) {

            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {

                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

            });
        }

        if ($request->filled('role')) {

            $query->whereHas('roles', function ($query) use ($request) {

                $query->where('name', $request->role);

            });
        }

        $users = $query
            ->latest()
            ->paginate(10);

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view(
            'users.index',
            compact(
                'users',
                'roles'
            )
        );
    }

    public function create(): View
    {

        abort_unless(
            auth()->user()->can('create users'),
            403
        );

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view(
            'users.create',
            compact('roles')
        );
    }

    public function store(UserRequest $request): RedirectResponse
    {

        abort_unless(
            auth()->user()->can('create users'),
            403
        );

        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('password'),
        ]);

        $user->syncRoles([
            $data['role'],
        ]);

        return redirect()
            ->route('users.show', $user)
            ->with(
                'success',
                'User created successfully.'
            );
    }

    public function show(User $user): View
    {

        abort_unless(
            auth()->user()->can('view users'),
            403
        );

        $user->load('roles');

        return view(
            'users.show',
            compact('user')
        );
    }

    public function edit(User $user): View
    {

        abort_unless(
            auth()->user()->can('update users'),
            403
        );

        $user->load('roles');

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view(
            'users.edit',
            compact(
                'user',
                'roles'
            )
        );
    }

    public function update(
        UserRequest $request,
        User $user
    ): RedirectResponse {

        abort_unless(
            auth()->user()->can('update users'),
            403
        );

        $data = $request->validated();

        $user->name = $data['name'];
        $user->email = $data['email'];

        // No Edit Password
        // if (! empty($data['password'])) {

        //     $user->password = Hash::make(
        //         $data['password']
        //     );

        // }

        $user->save();

        $user->syncRoles([
            $data['role'],
        ]);

        return redirect()
            ->route('users.show', $user)
            ->with(
                'success',
                'User updated successfully.'
            );
    }

    public function destroy(
        User $user
    ): RedirectResponse {

        abort_unless(
            auth()->user()->can('delete users'),
            403
        );

        if ($user->id === auth()->id()) {

            return back()->withErrors([
                'user' => 'You cannot delete your own account.',
            ]);

        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}
