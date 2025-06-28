@props(['type' => 'button'])

<button
    {{ $attributes->merge(['type' => $type, 'class' => 'bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300']) }}>
    {{ $slot }}
</button>
