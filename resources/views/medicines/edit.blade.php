<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Edit Medicine
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Update medicine details and minimum stock.
                </p>
            </div>

            <a href="{{ route('medicines.index') }}"
               class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($errors->any())
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 dark:border-rose-500/20 dark:bg-rose-500/10 dark:text-rose-200">
                    <p class="font-semibold mb-1">Please fix the following:</p>
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <form method="POST" action="{{ route('medicines.update', $medicine->id) }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                            <input
                                name="name"
                                value="{{ old('name', $medicine->name) }}"
                                class="mt-1 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                       px-4 py-2 text-gray-900 dark:text-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                                required
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Barcode</label>
                            <input
                                name="barcode"
                                value="{{ old('barcode', $medicine->barcode) }}"
                                class="mt-1 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                       px-4 py-2 text-gray-900 dark:text-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Min stock</label>
                            <input
                                type="number"
                                name="min_stock"
                                value="{{ old('min_stock', $medicine->min_stock) }}"
                                min="0"
                                class="mt-1 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                       px-4 py-2 text-gray-900 dark:text-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                                required
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Alert when stock goes below this number.</p>
                        </div>

                        <div class="flex flex-wrap gap-3 pt-2">
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                            >
                                Update
                            </button>

                            <a
                                href="{{ route('medicines.index') }}"
                                class="inline-flex items-center rounded-xl border border-gray-200 dark:border-gray-700 px-5 py-2.5 text-sm font-semibold
                                       text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-900/40"
                            >
                                Cancel
                            </a>

                            <form method="POST" action="{{ route('medicines.destroy', $medicine->id) }}"
                                  onsubmit="return confirm('Delete this medicine?')"
                                  class="sm:ml-auto">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-rose-500"
                                >
                                    Delete
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
