@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'border-gray-300 bg-white text-gray-700
        focus:border-gold focus:ring-gold rounded-md shadow-sm',
    ]) }}>
