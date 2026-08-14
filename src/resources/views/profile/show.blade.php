<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Profil Pengguna
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Paparan maklumat profil pengguna.
                </p>

            </div>

        </div>

    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <div class="flex items-center gap-4 mb-8">
                

                <div>
                    <p class="text-sm text-slate-500">Nama</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $user->name }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Emel
                    </p>
                    <p class="mt-2 text-slate-800 font-medium break-all">
                        {{ $user->email }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Peranan
                    </p>
                    <p class="mt-2 text-slate-800 font-medium">
                        {{ $user->roles->pluck('name')->implode(', ') ?: 'Tiada Peranan' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Dicipta Pada
                    </p>
                    <p class="mt-2 text-slate-800 font-medium">
                        {{ $user->created_at?->format('d/m/Y H:i') ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="flex justify-end mt-8 pt-6 border-t border-slate-100">
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
                >
                    Kembali
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
