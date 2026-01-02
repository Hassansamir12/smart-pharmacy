<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-white antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <!-- Background -->
        <div class="fixed inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 via-slate-950 to-purple-600/20"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(99,102,241,0.25),transparent_45%),radial-gradient(circle_at_80%_70%,rgba(168,85,247,0.25),transparent_45%)]"></div>
        </div>

        <div class="w-full max-w-md">
            <div class="mb-6 text-center">
                <div class="mx-auto h-12 w-12 rounded-2xl bg-white/10 grid place-items-center font-bold text-lg border border-white/10">
                    {{ strtoupper(substr(config('app.name','A'), 0, 1)) }}
                </div>
                <h1 class="mt-3 text-xl font-semibold">{{ config('app.name', 'My App') }}</h1>
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-xl shadow-black/40">
                {{ $slot }}
            </div>

            <p class="mt-6 text-center text-xs text-white/40">
                © {{ date('Y') }} {{ config('app.name', 'My App') }}
            </p>
        </div>
    </div>
</body>
</html>
