<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturerRequest;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LecturerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Lecturer::query()
            ->with('user');

        if ($request->filled('search')) {

            $search = $request->string('search')->trim();

            $query->where(function ($query) use ($search) {

                $query->where('staff_no', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");

            });
        }

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $lecturers = $query
            ->latest()
            ->paginate(10);

        return view(
            'lecturers.index',
            compact('lecturers')
        );
    }

    public function create(): View
    {
        return view('lecturers.create');
    }

    public function store(
        LecturerRequest $request
    ): RedirectResponse {

        $data = $request->validated();

        $lecturer = DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('Lecturer');

            return Lecturer::create([
                'user_id' => $user->id,
                'staff_no' => $data['staff_no'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);
        });

        return redirect()
            ->route('lecturers.show', $lecturer)
            ->with(
                'success',
                'Lecturer created successfully. User account has also been created.'
            );
    }

    public function show(
        Lecturer $lecturer
    ): View {

        $lecturer->load('user');

        return view(
            'lecturers.show',
            compact('lecturer')
        );
    }

    public function edit(
        Lecturer $lecturer
    ): View {

        return view(
            'lecturers.edit',
            compact('lecturer')
        );
    }

    public function update(
        LecturerRequest $request,
        Lecturer $lecturer
    ): RedirectResponse {

        $data = $request->validated();

        DB::transaction(function () use ($data, $lecturer) {

            $lecturer->update([
                'staff_no' => $data['staff_no'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);

            if ($lecturer->user) {

                $lecturer->user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
            }
        });

        return redirect()
            ->route('lecturers.show', $lecturer)
            ->with(
                'success',
                'Lecturer updated successfully.'
            );
    }

    public function destroy(
        Lecturer $lecturer
    ): RedirectResponse {

        DB::transaction(function () use ($lecturer) {

            $lecturer->delete();

            if ($lecturer->user) {
                $lecturer->user->delete();
            }
        });

        return redirect()
            ->route('lecturers.index')
            ->with(
                'success',
                'Lecturer deleted successfully.'
            );
    }
}
