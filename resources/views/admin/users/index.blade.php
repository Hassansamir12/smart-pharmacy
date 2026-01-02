<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                    Users
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage user roles (staff/admin).
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Success message --}}
            @if (session('status'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-200">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation errors --}}
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
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">List</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $users->count() }}
                        </span>
                    </div>

                    <div class="relative overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-900/40 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Role</th>
                                    <th class="px-4 py-3">Change role</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($users as $u)
                                    @php
                                        $isMe = $u->id === auth()->id();
                                    @endphp

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            <div class="flex items-center gap-2">
                                                <span>{{ $u->name }}</span>
                                                @if($isMe)
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">(You)</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-4 py-3">
                                            <span class="font-mono text-xs bg-gray-100 dark:bg-gray-900/40 px-2 py-1 rounded-lg">
                                                {{ $u->email }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3">
                                            @if($u->role === 'admin')
                                                <span class="inline-flex items-center rounded-full bg-indigo-100 px-2.5 py-0.5 text-xs font-semibold text-indigo-800
                                                             dark:bg-indigo-500/10 dark:text-indigo-200">
                                                    admin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-700
                                                             dark:bg-gray-500/10 dark:text-gray-200">
                                                    staff
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3">
                                            <form method="POST"
                                                  action="{{ route('admin.users.role', $u->id) }}"
                                                  class="flex flex-wrap items-center gap-2">
                                                @csrf
                                                @method('PUT')

                                                <select name="role"
                                                        @disabled($isMe)
                                                        class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/40
                                                               px-3 py-2 text-sm text-gray-900 dark:text-white
                                                               focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500
                                                               disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <option class="bg-white dark:bg-gray-900" value="staff" @selected($u->role === 'staff')>staff</option>
                                                    <option class="bg-white dark:bg-gray-900" value="admin" @selected($u->role === 'admin')>admin</option>
                                                </select>

                                                <button type="submit"
                                                        @disabled($isMe)
                                                        class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500
                                                               disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-indigo-600">
                                                    Save
                                                </button>

                                                @if($isMe)
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                                        You can’t change your own role.
                                                    </span>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
