{{-- resources\views\components\forms\text-input.blade.php --}}
@props(['disabled' => false, 'name', 'id' => null, 'label' => null])

<div>
    @if ($label)
        <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
        </label>
    @endif
    <input id="{{ $id ?? $name }}" name="{{ $name }}" @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'w-full px-3 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg
                                focus:border-gold focus:ring-gold shadow-sm',
        ]) }}>
</div>
