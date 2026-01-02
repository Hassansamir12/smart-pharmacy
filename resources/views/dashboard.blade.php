<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Pharmacy overview and quick actions
                </p>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <span class="text-xs px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-500/20">
                    {{ now()->toFormattedDateString() }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Banner --}}
            <div class="relative overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div
                    class="h-40 sm:h-44 bg-cover bg-center"
                    style="background-image: url('{{ Vite::asset('resources/images/pharmacy1.jpg') }}');">
                </div>

                <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/25 to-transparent"></div>

                <div class="absolute inset-0 p-6 flex items-end">
                    <div class="text-white">
                        <div class="text-lg font-semibold">Welcome back</div>
                        <div class="text-sm text-white/80">
                            Inventory • Batches • Expiry alerts • Audit logs
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                {{-- Medicines --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Medicines</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $medicinesCount ?? 0 }}
                                </p>
                            </div>
                            <div class="h-11 w-11 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 grid place-items-center">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75h6A2.25 2.25 0 0117.25 6v12A2.25 2.25 0 0115 20.25H9A2.25 2.25 0 016.75 18V6A2.25 2.25 0 019 3.75z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7.5h6M9 11.25h6M9 15h6" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('medicines.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                                Open →
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Batches --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Batches</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $batchesCount ?? 0 }}
                                </p>
                            </div>
                            <div class="h-11 w-11 rounded-xl bg-sky-50 dark:bg-sky-500/10 grid place-items-center">
                                <svg class="h-6 w-6 text-sky-600 dark:text-sky-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5h16.5M6.75 7.5v12.75h10.5V7.5" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('batches.index') }}" class="text-sm font-semibold text-sky-600 hover:text-sky-500 dark:text-sky-300">
                                Open →
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Expired --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Expired</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $expiredCount ?? 0 }}
                                </p>
                            </div>
                            <div class="h-11 w-11 rounded-xl bg-rose-50 dark:bg-rose-500/10 grid place-items-center">
                                <svg class="h-6 w-6 text-rose-600 dark:text-rose-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4.5m0 3h.01" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('alerts.expiry') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-500 dark:text-rose-300">
                                View alerts →
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Expiring soon (FIXED SVG) --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Expiring soon</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $expiringSoonCount ?? 0 }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Next {{ $days ?? 30 }} days
                                </p>
                            </div>
                            <div class="h-11 w-11 rounded-xl bg-amber-50 dark:bg-amber-500/10 grid place-items-center">
                                <svg class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('alerts.expiry') }}" class="text-sm font-semibold text-amber-600 hover:text-amber-500 dark:text-amber-300">
                                View alerts →
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Low stock --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Low stock</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $lowStockCount ?? 0 }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Qty ≤ min stock
                                </p>
                            </div>
                            <div class="h-11 w-11 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 grid place-items-center">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3h.01" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 19.5h10.5c1.2 0 2.25-1.05 2.25-2.25V6.75c0-1.2-1.05-2.25-2.25-2.25H6.75c-1.2 0-2.25 1.05-2.25 2.25v10.5c0 1.2 1.05 2.25 2.25 2.25z" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('medicines.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                                View medicines →
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Quick actions --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Quick actions</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create records faster.</p>

                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="{{ route('medicines.create') }}" class="px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-500">
                            + Add medicine
                        </a>

                        <a href="{{ route('batches.create') }}" class="px-4 py-2 rounded-xl bg-sky-600 text-white hover:bg-sky-500">
                            + Add batch
                        </a>

                        <a href="{{ route('alerts.expiry') }}" class="px-4 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-800 dark:bg-white/10 dark:hover:bg-white/15">
                            Open expiry alerts
                        </a>

                        @can('manage-users')
                            <a href="{{ route('admin.audit-logs.index') }}" class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500">
                                Audit logs
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
