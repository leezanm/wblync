<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-2xl">

            Create Academic Session

        </h2>

    </x-slot>

    <div class="py-8">

        <div class="max-w-6xl mx-auto">

            <div class="bg-white rounded-2xl shadow p-8">

                <form
                    action="{{ route('academic-sessions.store') }}"
                    method="POST">

                    @csrf

                    @include('academic-sessions.form')

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
