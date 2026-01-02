<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Audit Logs
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Track create / update / delete actions.
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                      text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40 transition">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">

                    <!-- wrapper -->
                    <div class="relative overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
                        <!-- make table scroll horizontally on small screens -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                                <thead class="sticky top-0 z-10 bg-gray-50/95 backdrop-blur text-xs uppercase text-gray-500
                                              dark:bg-gray-900/70 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 whitespace-nowrap">Time</th>
                                        <th class="px-4 py-3 whitespace-nowrap">User</th>
                                        <th class="px-4 py-3 whitespace-nowrap">Event</th>
                                        <th class="px-4 py-3 whitespace-nowrap">Model</th>
                                        <th class="px-4 py-3 whitespace-nowrap">ID</th>
                                        <th class="px-4 py-3 min-w-[420px]">Changes</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse($logs as $log)
                                        @php
                                            $event = strtolower($log->event ?? $log->description ?? '');
                                            $attrs = $log->properties['attributes'] ?? null; // new values
                                            $old   = $log->properties['old'] ?? null;        // old values
                                        @endphp

                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30 align-top transition">
                                            <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-600 dark:text-gray-300">
                                                <div class="font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $log->created_at?->format('Y-m-d') }}
                                                </div>
                                                <div class="mt-0.5 text-gray-500 dark:text-gray-400">
                                                    {{ $log->created_at?->format('H:i:s') }}
                                                </div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $log->causer?->name ?? 'System' }}
                                                </div>
                                                @if($log->causer?->email ?? false)
                                                    <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $log->causer->email }}
                                                    </div>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3">
                                                @php
                                                    $badge = 'bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-200';

                                                    if (str_contains($event, 'created')) $badge = 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300';
                                                    if (str_contains($event, 'updated')) $badge = 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-300';
                                                    if (str_contains($event, 'deleted')) $badge = 'bg-rose-50 text-rose-700 dark:bg-rose-500/10 dark:text-rose-300';
                                                @endphp

                                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold border border-black/5 dark:border-white/10 {{ $badge }}">
                                                    {{ $log->event ?? $log->description }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3">
                                                <span class="inline-flex items-center rounded-lg px-2 py-1 text-xs font-semibold
                                                             bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">
                                                    {{ class_basename($log->subject_type ?? '') ?: '—' }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3">
                                                <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">
                                                    {{ $log->subject_id ?? '—' }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3">
                                                @if($attrs || $old)
                                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                                                        <div class="rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/40 p-3">
                                                            <div class="text-xs font-semibold text-gray-600 dark:text-gray-300 mb-2">
                                                                Old
                                                            </div>
                                                            @if($old)
                                                                <pre class="text-xs whitespace-pre-wrap text-gray-700 dark:text-gray-200">{{ json_encode($old, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            @else
                                                                <div class="text-xs text-gray-500 dark:text-gray-400">—</div>
                                                            @endif
                                                        </div>

                                                        <div class="rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/40 p-3">
                                                            <div class="text-xs font-semibold text-gray-600 dark:text-gray-300 mb-2">
                                                                New
                                                            </div>
                                                            @if($attrs)
                                                                <pre class="text-xs whitespace-pre-wrap text-gray-700 dark:text-gray-200">{{ json_encode($attrs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            @else
                                                                <div class="text-xs text-gray-500 dark:text-gray-400">—</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-gray-500 dark:text-gray-400">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                                                No audit logs yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-5">
                        {{ $logs->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
