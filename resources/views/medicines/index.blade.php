<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Medicines
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Search by name or barcode and manage minimum stock.
                </p>
            </div>

            <a href="{{ route('medicines.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                + Add medicine
            </a>
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

                    <form method="GET" action="{{ route('medicines.index') }}" class="flex flex-col sm:flex-row gap-2">
                        <input
                            name="q"
                            value="{{ $q }}"
                            placeholder="Search name or barcode..."
                            class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                   px-4 py-2 text-gray-900 dark:text-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                        />

                        <div class="flex gap-2">
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
                            >
                                Search
                            </button>

                            <a
                                href="{{ route('medicines.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold
                                       text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40"
                            >
                                Reset
                            </a>
                        </div>
                    </form>

                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">List</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Showing {{ $medicines->count() }} of {{ $medicines->total() }}
                        </span>
                    </div>

                    <div class="relative overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-900/40 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Barcode</th>
                                    <th class="px-4 py-3">Min stock</th>
                                    <th class="px-4 py-3 text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($medicines as $m)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $m->name }}
                                        </td>

                                        <td class="px-4 py-3">
                                            @if($m->barcode)
                                                <span class="font-mono text-xs bg-gray-100 dark:bg-gray-900/40 px-2 py-1 rounded-lg">
                                                    {{ $m->barcode }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $m->min_stock ?? 0 }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('medicines.edit', $m->id) }}"
                                                   class="inline-flex items-center rounded-lg border border-gray-200 dark:border-gray-700 px-3 py-1.5 text-sm hover:bg-gray-50 dark:hover:bg-gray-900/40">
                                                    Edit
                                                </a>

                                                <form method="POST" action="{{ route('medicines.destroy', $m->id) }}"
                                                      onsubmit="return confirm('Delete this medicine?')" class="inline">
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
                                        <td colspan="4" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                            No medicines found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-2">
                        {{ $medicines->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
