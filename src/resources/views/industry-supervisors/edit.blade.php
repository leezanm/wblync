<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Industry Mentor
                </h2>


            </div>

        </div>

    </x-slot>

   <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Edit Industry Mentor
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Update industry mentor information.
                </p>

            </div>

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <div class="mb-8">

                <h3 class="text-lg font-bold text-slate-800">
                    Industry Mentor Information
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $industrySupervisor->name ?? '-' }}
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('industry-supervisors.update', $industrySupervisor) }}"
            >

                @csrf
                @method('PUT')

                @include('industry-supervisors._form')

            </form>

        </div>

    </div>

</x-app-layout>
