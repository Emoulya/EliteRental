{{-- resources/views/components/buttons/primary-button.blade.php --}}
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-gold text-navy font-bold px-5 py-2 rounded-lg hover:bg-yellow-500 transition duration-300']) }}>
    {{ $slot }}
</button>
