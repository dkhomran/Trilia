@props(['primary', 'action', 'type', 'id', 'form', 'accept', 'outline'])

<button @isset($action) onclick="{{ $action }}" @endisset
    @isset($form) form="{{ $form }}" @endisset
    @isset($type) type="{{ $type }}" @endisset
    @isset($id) id="{{ $id }}" @endisset
    @if (isset($primary))
    {{ $attributes->merge(['class' => 'flex items-center justify-center w-full gap-2 px-6 py-1 text-base font-bold border-4 border-black  bg-black text-white hover:text-white']) }}>
    @elseif (isset($outline))
    {{ $attributes->merge(['class' => 'flex items-center justify-center w-full gap-2 px-6 py-1 text-base font-bold border-4 border-black  bg-white text-black hover:text-white']) }}>
    @else
    {{ $attributes->merge(['class' => 'flex items-center justify-center w-full gap-2 px-6 py-1 text-base font-bold border-4  text-black bg-slate-300 border-slate-300 ']) }}>
    @endif
    {{ $slot }}
</button>


