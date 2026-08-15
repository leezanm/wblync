<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Review Weekly Logbook
                </h2>


            </div>



        </div>

    </x-slot>

   <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Review Weekly Logbook
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Review the student's weekly internship logbook before approval.
                </p>
            </div>

            <a
                href="{{ route('industry-supervisor.logbook-approvals.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Approvals
            </a>

        </div>
    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error --}}
    @if (session('error'))

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm font-medium text-red-800">
            {{ session('error') }}
        </div>

    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">

            <p class="text-sm font-semibold text-red-800 mb-2">
                Please correct the following errors:
            </p>

            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Student / Placement Information --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Student --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Student
                </p>

                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $weeklyLogbookSubmission->placement->student->name ?? '-' }}
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $weeklyLogbookSubmission->placement->student->student_no ?? '-' }}
                </p>

            </div>


            {{-- Company --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Company
                </p>

                <p class="text-lg font-bold text-slate-800 mt-1">
                    {{ $weeklyLogbookSubmission->placement->company->name ?? '-' }}
                </p>

            </div>


            {{-- Week --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Week
                </p>

                <p class="text-lg font-bold text-slate-800 mt-1">

                    {{ $weeklyLogbookSubmission->week_start_date->format('d M Y') }}

                    <span class="text-slate-400 font-normal">
                        -
                    </span>

                    {{ $weeklyLogbookSubmission->week_end_date->format('d M Y') }}

                </p>

            </div>


            {{-- Status --}}
            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Status
                </p>

                <div class="mt-2">

                    @if ($weeklyLogbookSubmission->status === 'Submitted')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                            Pending Approval

                        </span>

                    @elseif ($weeklyLogbookSubmission->status === 'Approved')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            Approved

                        </span>

                    @elseif ($weeklyLogbookSubmission->status === 'Rejected')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Rejected

                        </span>

                    @endif

                </div>

            </div>

        </div>


        @if ($weeklyLogbookSubmission->submitted_at)

            <div class="mt-6 pt-5 border-t border-slate-100">

                <p class="text-xs text-slate-400">
                    Submitted on
                </p>

                <p class="text-sm font-medium text-slate-700 mt-1">
                    {{ $weeklyLogbookSubmission->submitted_at->format('d M Y, h:i A') }}
                </p>

            </div>

        @endif

    </div>


    {{-- Daily Logbooks --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

        <div class="p-6 border-b border-slate-100">

            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                    Daily Records
                </p>

                <h3 class="text-xl font-bold text-slate-800 mt-1">
                    Weekly Activities
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Review all daily records before approving this weekly submission.
                </p>

            </div>

        </div>


        <div class="divide-y divide-slate-100">

            @forelse ($weeklyLogbookSubmission->dailyLogbooks as $logbook)

                <div class="p-6">

                    <div class="flex flex-col lg:flex-row lg:items-start gap-6">

                        {{-- Date --}}
                        <div class="lg:w-40 shrink-0">

                            <p class="text-sm font-bold text-slate-800">
                                {{ $logbook->log_date->format('d M Y') }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $logbook->log_date->format('l') }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div class="lg:w-40 shrink-0">

                            @switch($logbook->work_status)

                                @case('Working')

                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                        Working
                                    </span>

                                    @break

                                @case('Off Day')

                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                        Off Day
                                    </span>

                                    @break

                                @case('Public Holiday')

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                                        Public Holiday
                                    </span>

                                    @break

                                @case('Leave')

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                        Leave
                                    </span>

                                    @break

                                @case('Medical Leave')

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        Medical Leave
                                    </span>

                                    @break

                                @default

                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                        {{ $logbook->work_status ?? 'Not Set' }}
                                    </span>

                            @endswitch

                        </div>


                        {{-- Activity --}}
                        <div class="flex-1 min-w-0">

                            @if ($logbook->activity)

                                <p class="text-sm font-semibold text-slate-700 mb-1">
                                    Activity
                                </p>

                                <p class="text-sm text-slate-600 whitespace-pre-line">
                                    {{ $logbook->activity }}
                                </p>

                            @endif


                            @if ($logbook->learning_outcome)

                                <div class="mt-4">

                                    <p class="text-sm font-semibold text-slate-700 mb-1">
                                        Learning Outcome
                                    </p>

                                    <p class="text-sm text-slate-600 whitespace-pre-line">
                                        {{ $logbook->learning_outcome }}
                                    </p>

                                </div>

                            @endif


                            @if ($logbook->remarks)

                                <div class="mt-4">

                                    <p class="text-sm font-semibold text-slate-700 mb-1">
                                        Remarks
                                    </p>

                                    <p class="text-sm text-slate-600 whitespace-pre-line">
                                        {{ $logbook->remarks }}
                                    </p>

                                </div>

                            @endif

                        </div>


                        {{-- Working Hours --}}
                        <div class="lg:w-28 shrink-0 lg:text-right">

                            <p class="text-xs uppercase tracking-wide text-slate-400 font-semibold">
                                Hours
                            </p>

                            @if ($logbook->working_hours !== null)

                                <p class="text-lg font-bold text-slate-800 mt-1">

                                    {{ $logbook->working_hours }}

                                </p>

                                <p class="text-xs text-slate-400">
                                    {{ $logbook->working_hours == 1 ? 'hour' : 'hours' }}
                                </p>

                            @else

                                <p class="text-sm text-slate-400 mt-1">
                                    -
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-12 text-center">

                    <p class="text-sm text-slate-500">
                        No daily logbook records found.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- Approval Actions --}}
    @if ($weeklyLogbookSubmission->status === 'Submitted')

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h3 class="text-lg font-bold text-slate-800">
                Supervisor Review
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Approve the weekly logbook or reject it with remarks for the student.
            </p>


            {{-- Remarks --}}
            <div class="mt-6">

                <label
                    for="remarks"
                    class="block text-sm font-semibold text-slate-700 mb-2"
                >
                    Supervisor Remarks
                    <span class="text-slate-400 font-normal">
                        (required when rejecting)
                    </span>
                </label>

                <textarea
                    id="remarks"
                    name="remarks"
                    form="reject-logbook-form"
                    rows="4"
                    placeholder="Enter remarks if you need the student to make corrections..."
                    class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                ></textarea>

                @error('remarks')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Buttons --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6">

                {{-- Reject --}}
                <form
                    id="reject-logbook-form"
                    method="POST"
                    action="{{ route(
                        'industry-supervisor.logbook-approvals.reject',
                        $weeklyLogbookSubmission
                    ) }}"
                    onsubmit="return confirm('Reject this weekly logbook? The student will need to make corrections and resubmit.');"
                >

                    @csrf

                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition"
                    >

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                        Reject

                    </button>

                </form>


                {{-- Approve --}}
                <form
                    method="POST"
                    action="{{ route(
                        'industry-supervisor.logbook-approvals.approve',
                        $weeklyLogbookSubmission
                    ) }}"
                    onsubmit="return confirm('Approve this weekly logbook?');"
                >

                    @csrf

                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition"
                    >

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Approve

                    </button>

                </form>

            </div>

        </div>

    @else

        {{-- Already Reviewed --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            @if ($weeklyLogbookSubmission->status === 'Approved')

                <div class="flex items-start gap-4">

                    <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center shrink-0">

                        <svg
                            class="w-6 h-6 text-green-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="font-bold text-green-700">
                            Weekly Logbook Approved
                        </h3>

                        @if ($weeklyLogbookSubmission->reviewed_at)

                            <p class="text-sm text-slate-500 mt-1">
                                Reviewed on
                                {{ $weeklyLogbookSubmission->reviewed_at->format('d M Y, h:i A') }}
                            </p>

                        @endif

                        @if ($weeklyLogbookSubmission->remarks)

                            <p class="text-sm text-slate-600 mt-3">
                                {{ $weeklyLogbookSubmission->remarks }}
                            </p>

                        @endif

                    </div>

                </div>


            @elseif ($weeklyLogbookSubmission->status === 'Rejected')

                <div class="flex items-start gap-4">

                    <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center shrink-0">

                        <svg
                            class="w-6 h-6 text-red-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="font-bold text-red-700">
                            Weekly Logbook Rejected
                        </h3>

                        @if ($weeklyLogbookSubmission->reviewed_at)

                            <p class="text-sm text-slate-500 mt-1">
                                Reviewed on
                                {{ $weeklyLogbookSubmission->reviewed_at->format('d M Y, h:i A') }}
                            </p>

                        @endif

                        @if ($weeklyLogbookSubmission->remarks)

                            <div class="mt-3 rounded-xl bg-red-50 border border-red-100 p-4">

                                <p class="text-xs uppercase tracking-wide font-semibold text-red-500">
                                    Remarks
                                </p>

                                <p class="text-sm text-red-700 mt-1">
                                    {{ $weeklyLogbookSubmission->remarks }}
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            @endif

        </div>

    @endif

</x-app-layout>
