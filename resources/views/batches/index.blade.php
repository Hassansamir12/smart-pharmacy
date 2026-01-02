<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Batches
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Filter by medicine/supplier and track expiry.
                </p>
            </div>

            <div class="flex items-center gap-2">
                {{-- Expiry Alerts button --}}
                <a href="{{ route('alerts.expiry', 30) }}"
                   class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                          text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40">
                    Expiry Alerts
                </a>

                {{-- Add batch button --}}
                <a href="{{ route('batches.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                    + Add batch
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('status'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 space-y-4">

                    <form method="GET" action="{{ route('batches.index') }}" class="space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <input
                                name="q"
                                value="{{ $q }}"
                                placeholder="Search medicine / supplier / batch no..."
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                       px-4 py-2 text-gray-900 dark:text-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                            />

                            <select name="medicine_id"
                                    class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                           px-4 py-2 text-gray-900 dark:text-white
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500">
                                <option class="bg-white dark:bg-gray-900" value="">All medicines</option>
                                @foreach($medicines as $m)
                                    <option class="bg-white dark:bg-gray-900" value="{{ $m->id }}" @selected((string)$medicineId === (string)$m->id)>
                                        {{ $m->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="supplier_id"
                                    class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                           px-4 py-2 text-gray-900 dark:text-white
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500">
                                <option class="bg-white dark:bg-gray-900" value="">All suppliers</option>
                                @foreach($suppliers as $s)
                                    <option class="bg-white dark:bg-gray-900" value="{{ $s->id }}" @selected((string)$supplierId === (string)$s->id)>
                                        {{ $s->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="flex gap-2">
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                                    Filter
                                </button>

                                <a href="{{ route('batches.index') }}"
                                   class="w-full inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                                          text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40">
                                    Reset
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                            <div>
                                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Expiry from</label>
                                <input type="date" name="expiry_from" value="{{ $expiryFrom }}"
                                       class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                              px-4 py-2 text-gray-900 dark:text-white
                                              focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500" />
                            </div>

                            <div>
                                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Expiry to</label>
                                <input type="date" name="expiry_to" value="{{ $expiryTo }}"
                                       class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                              px-4 py-2 text-gray-900 dark:text-white
                                              focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500" />
                            </div>

                            <div class="hidden md:block"></div>
                            <div class="hidden md:block"></div>
                        </div>
                    </form>

                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">List</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Showing {{ $batches->count() }} of {{ $batches->total() }}
                        </span>
                    </div>

                    <div class="relative overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-900/40 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Medicine</th>
                                    <th class="px-4 py-3">Supplier</th>
                                    <th class="px-4 py-3">Batch No</th>
                                    <th class="px-4 py-3">Expiry</th>
                                    <th class="px-4 py-3">Qty</th>
                                    <th class="px-4 py-3 text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($batches as $b)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $b->medicine->name }}
                                        </td>
                                        <td class="px-4 py-3">{{ $b->supplier?->name ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            @if($b->batch_no)
                                                <span class="font-mono text-xs bg-gray-100 dark:bg-gray-900/40 px-2 py-1 rounded-lg">
                                                    {{ $b->batch_no }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-mono text-xs bg-gray-100 dark:bg-gray-900/40 px-2 py-1 rounded-lg">
                                                {{ $b->expiry_date }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $b->quantity }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('batches.edit', $b->id) }}"
                                                   class="inline-flex items-center rounded-lg border border-gray-200 dark:border-gray-700 px-3 py-1.5 text-sm hover:bg-gray-50 dark:hover:bg-gray-900/40">
                                                    Edit
                                                </a>

                                                <form method="POST" action="{{ route('batches.destroy', $b->id) }}"
                                                      onsubmit="return confirm('Delete this batch?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center rounded-lg bg-rose-600 px-3 py-1.5 text-sm font-semibold text-white hover:bg-rose-500">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                            No batches found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-2">
                        {{ $batches->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
