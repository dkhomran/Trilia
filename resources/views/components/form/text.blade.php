@props(['name', 'icon', 'label', 'placeholder', 'required', 'autofocus', 'value'])

<div data-role="form-text"
    {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center w-full gap-2']) }}>
    @isset($label)
        <label for="input-text-{{ $name }}" class="w-full text-black font-semibold ">{{ $label }}</label>
    @endisset
    <div class="flex items-center justify-center w-full gap-2 px-3 py-2 text-base border-2 border-black">
        @isset($icon)
            <div class="w-4 h-4 text-black">@svg($icon)</div>
        @endisset
        <input type="text" class="flex-grow outline-none"
            @isset($placeholder) placeholder="{{ $placeholder }}" @endisset name="{{ $name }}"
            id="input-text-{{ $name }}" @isset($required) required @endisset
            @isset($autofocus) autofocus @endisset
            @isset($value) value="{{ $value }}" @endisset>
    </div>
</div>
