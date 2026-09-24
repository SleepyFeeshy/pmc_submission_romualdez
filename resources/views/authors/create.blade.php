<x-layout>
    <form method="POST" action="{{ route('authors.store') }}">
        @method('POST')
        @csrf
        <input
            id="name"
            type="text"
            name="name"
        >
        <input
            id="birth_date"
            type="date"
            name="birth_date"
        >
        <button type="submit"> Submit </button>
        </input>
    </form>
</x-layout>