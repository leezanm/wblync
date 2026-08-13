<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $academicSessionsCount = AcademicSession::count();

        $currentAcademicSession = AcademicSession::query()
            ->where('current', true)
            ->orderByDesc('start_date')
            ->first();

        return view('dashboard', [
            'academicSessionsCount' => $academicSessionsCount,
            'currentAcademicSession' => $currentAcademicSession,
        ]);
    }
}
