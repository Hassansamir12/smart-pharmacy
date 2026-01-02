<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-white">Create account</h2>
        <p class="mt-1 text-sm text-white/60">Register as staff, or admin (admin only).</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Role')" />

            <select id="role" name="role"
                class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-900/60 text-white shadow-sm focus:border-indigo-400 focus:ring-indigo-400"
                required>
                <option class="bg-slate-900" value="staff" {{ old('role', 'staff') === 'staff' ? 'selected' : '' }}>
                    Staff
                </option>

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <option class="bg-slate-900" value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                @endif
            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-sm text-white/70 hover:text-white underline" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="rounded-xl bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 active:bg-indigo-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
