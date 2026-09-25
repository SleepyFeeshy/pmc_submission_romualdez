@props(['id', 'name', 'value' => null])

<label class="text-sm text-gray-700" for="name">
    {{ ucwords($name) }}
</label>
<input
    class="bg-gray-100 p-1"
    id="{{ $id }}"
    type="date"
    name="{{ $name }}"
    value="{{ $value }}"
>