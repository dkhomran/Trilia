@props(['type' => 'text', 'label', 'value' => null])

<div>
    <label for="{{ $attributes->get('id') }}" class="block font-semibold">{{ $label }}</label>
    <input type="{{ $type }}" {{ $attributes->merge(['class' => 'border rounded px-2 py-1']) }} value="{{ $value }}" />
</div>
