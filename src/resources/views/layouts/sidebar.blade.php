

@php
    $user = auth()->user();
@endphp

@if ($user->hasRole('Super Admin'))

    @include('layouts.sidebar-superadmin')

@elseif ($user->hasRole('WBL Coordinator'))

    @include('layouts.sidebar-coordinator')

@elseif ($user->hasRole('Lecturer'))

    @include('layouts.sidebar-lecturer')

@elseif ($user->hasRole('Industry Mentor'))

    @include('layouts.sidebar-industry-mentor')

@elseif ($user->hasRole('Student'))

    @include('layouts.sidebar-student')

@endif
