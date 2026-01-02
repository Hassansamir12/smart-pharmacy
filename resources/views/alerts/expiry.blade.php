<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Expiry Alerts
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Next {{ $days }} days
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('alerts.expiry.export.excel', ['days' => $days]) }}"
                   class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                          text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40">
                    Export Excel
                </a>

                <a href="{{ route('alerts.expiry.export.pdf', ['days' => $days]) }}"
                   class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                          text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40">
                    Export PDF
                </a>

                <a href="{{ route('batches.index') }}"
                   class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                          text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40">
                    ← Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Expired --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Expired</h3>
                            <span class="inline-flex items-center rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-semibold text-rose-800
                                         dark:bg-rose-500/10 dark:text-rose-200">
                                {{ $expired->count() }}
                            </span>
                        </div>

                        <span class="inline-flex items-center rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-semibold text-rose-800
                                     dark:bg-rose-500/10 dark:text-rose-200">
                            Expired
                        </span>
                    </div>

                    <div class="relative overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-900/40 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Medicine</th>
                                    <th class="px-4 py-3">Supplier</th>
                                    <th class="px-4 py-3">Expiry</th>
                                    <th class="px-4 py-3">Qty</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($expired as $b)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $b->medicine->name }}
                                        </td>
                                        <td class="px-4 py-3">{{ $b->supplier?->name ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-semibold text-rose-800
                                                         dark:bg-rose-500/10 dark:text-rose-200">
                                                {{ $b->expiry_date }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $b->quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                            No expired batches.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Expiring soon --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Expiring Soon</h3>
                            <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800
                                         dark:bg-amber-500/10 dark:text-amber-200">
                                {{ $expiringSoon->count() }}
                            </span>
                        </div>

                        <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800
                                     dark:bg-amber-500/10 dark:text-amber-200">
                            Next {{ $days }} days
                        </span>
                    </div>

                    <div class="relative overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-900/40 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Medicine</th>
                                    <th class="px-4 py-3">Supplier</th>
                                    <th class="px-4 py-3">Expiry</th>
                                    <th class="px-4 py-3">Qty</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($expiringSoon as $b)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $b->medicine->name }}
                                        </td>
                                        <td class="px-4 py-3">{{ $b->supplier?->name ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800
                                                         dark:bg-amber-500/10 dark:text-amber-200">
                                                {{ $b->expiry_date }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $b->quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                            No batches expiring soon.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
