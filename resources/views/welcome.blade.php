<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CDN (quick + nice for landing page) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-950 text-white">
    <header class="mx-auto max-w-6xl px-6 py-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-xl bg-white/10 grid place-items-center font-bold">
                {{ strtoupper(substr(config('app.name', 'A'), 0, 1)) }}
            </div>
            <span class="font-semibold tracking-wide">{{ config('app.name', 'My App') }}</span>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-16">
        <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold leading-tight">
                    Manage your inventory and expiry alerts easily.
                </h1>

                <p class="mt-4 text-white/70 text-lg">
                    Track items, get expiry notifications, and keep everything organized from one dashboard.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    @guest
                        <a href="{{ route('login') }}"
                           class="rounded-xl px-6 py-3 font-semibold bg-white text-slate-950 hover:bg-white/90">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="rounded-xl px-6 py-3 font-semibold bg-indigo-500 hover:bg-indigo-400">
                                Create account
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/dashboard') }}"
                           class="rounded-xl px-6 py-3 font-semibold bg-white text-slate-950 hover:bg-white/90">
                            Go to dashboard
                        </a>
                    @endguest
                </div>
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="rounded-xl bg-white/5 p-4 border border-white/10">
                        <p class="text-white/60">Feature</p>
                        <p class="mt-1 font-semibold">Expiry alerts</p>
                    </div>

                    <div class="rounded-xl bg-white/5 p-4 border border-white/10">
                        <p class="text-white/60">Feature</p>
                        <p class="mt-1 font-semibold">Item tracking</p>
                    </div>

                    <div class="rounded-xl bg-white/5 p-4 border border-white/10">
                        <p class="text-white/60">Feature</p>
                        <p class="mt-1 font-semibold">Reports</p>
                    </div>

                    <div class="rounded-xl bg-white/5 p-4 border border-white/10">
                        <p class="text-white/60">Feature</p>
                        <p class="mt-1 font-semibold">User accounts</p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="mt-16 text-sm text-white/50">
            {{ config('app.name', 'My App') }} • Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </main>
</body>
</html>
