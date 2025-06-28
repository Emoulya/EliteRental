@props(['name', 'value', 'label', 'id' => null])

<label class="flex items-center">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}"
        id="{{ $id ?? $name . '_' . Str::slug($value) }}"
        {{ $attributes->merge(['class' => 'rounded border-gray-300 text-gold focus:ring-gold']) }} />
    <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
</label>
