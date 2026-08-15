<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Lecturers
            </h2>


        </div>

    </x-slot>


    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <div class="mb-8">

                <h3 class="text-lg font-bold text-slate-800">
                    Add Lecturer Information
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    A user account with the Lecturer role will be created automatically.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('lecturers.store') }}"
            >

                @csrf

                @include('lecturers._form')

            </form>

        </div>

    </div>

</x-app-layout>
