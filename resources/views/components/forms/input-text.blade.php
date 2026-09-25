@props(['id', 'placeholder', 'name', 'value'])

<label class="text-sm text-gray-700" for="name">
    {{ ucwords($name) }}
</label>
<input
    class="bg-gray-100 p-1 w-full"
    id="{{ $id }}"
    type="text"
    placeholder="{{ $placeholder }}"
    name="{{ $name }}"
    value="{{ $value }}"
>