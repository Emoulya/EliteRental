@props(['disabled' => false, 'name', 'id' => null, 'label' => null, 'rows' => 3])

<div>
    @if ($label)
        <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
        </label>
    @endif
    <textarea id="{{ $id ?? $name }}" name="{{ $name }}" rows="{{ $rows }}" @disabled($disabled)
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold']) }}>{{ $slot }}</textarea>
</div>
