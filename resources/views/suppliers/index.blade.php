<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Suppliers
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Search suppliers and manage contact details.
                </p>
            </div>

            <a href="{{ route('suppliers.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                + Add supplier
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

                    <form method="GET" action="{{ route('suppliers.index') }}" class="flex flex-col sm:flex-row gap-2">
                        <input
                            name="q"
                            value="{{ $q }}"
                            placeholder="Search name, phone, or address..."
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
                                href="{{ route('suppliers.index') }}"
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
                            Showing {{ $suppliers->count() }} of {{ $suppliers->total() }}
                        </span>
                    </div>

                    <div class="relative overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-900/40 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Phone</th>
                                    <th class="px-4 py-3">Address</th>
                                    <th class="px-4 py-3 text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($suppliers as $s)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $s->name }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $s->phone ?: '—' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $s->address ?: '—' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('suppliers.edit', $s->id) }}"
                                                   class="inline-flex items-center rounded-lg border border-gray-200 dark:border-gray-700 px-3 py-1.5 text-sm hover:bg-gray-50 dark:hover:bg-gray-900/40">
                                                    Edit
                                                </a>

                                                <form method="POST" action="{{ route('suppliers.destroy', $s->id) }}"
                                                      onsubmit="return confirm('Delete this supplier?')" class="inline">
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
                                            No suppliers found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-2">
                        {{ $suppliers->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
