@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'block w-full rounded-xl border border-slate-800 bg-slate-900/60 text-white placeholder-white/40 shadow-sm
                    focus:border-indigo-400 focus:ring-indigo-400
                    disabled:opacity-60 disabled:cursor-not-allowed'
    ]) !!}
>
