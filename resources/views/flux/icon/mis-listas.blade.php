{{-- Credit: Lucide (https://lucide.dev) --}}

@props([
    'variant' => 'outline',
])

@php
    if ($variant === 'solid') {
        throw new \Exception('The "solid" variant is not supported in Lucide.');
    }

    $classes = Flux::classes('shrink-0')->add(
        match ($variant) {
            'outline' => '[:where(&)]:size-6',
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
        },
    );

    $strokeWidth = match ($variant) {
        'outline' => 2,
        'mini' => 2.25,
        'micro' => 2.5,
    };
@endphp

<svg
    {{ $attributes->class($classes) }}
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.5"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    data-slot="icon"
>
<svg viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M20,20 C20.553,20 21,20.447 21,21 C21,21.553 20.553,22 20,22 L4,22 C3.447,22 3,21.553 3,21 C3,20.447 3.447,20 4,20 L20,20 Z M24,13 C24.553,13 25,13.447 25,14 C25,14.553 24.553,15 24,15 L4,15 C3.447,15 3,14.553 3,14 C3,13.447 3.447,13 4,13 L24,13 Z M22,6 C22.553,6 23,6.447 23,7 C23,7.553 22.553,8 22,8 L4,8 C3.447,8 3,7.553 3,7 C3,6.447 3.447,6 4,6 L22,6 Z"></path></svg>
</svg>
