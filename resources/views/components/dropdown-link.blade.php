{{-- resources/views/components/dropdown-link.blade.php --}}
<a
    {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-grayCustom
        hover:bg-gold hover:text-white focus:outline-none focus:bg-gold focus:text-white
        transition duration-150 ease-in-out',
    ]) }}>
    {{ $slot }}
</a>
