<html>
    <body>
        <h1>Editing Book</h1>
        <form method="POST" action="{{ route('books.update', $book->id) }}">
            @method('PUT')
            @csrf
            <input
                id="title"
                type="text"
                name="title"
                value="{{ $book->title }}"
            >
            <input
                id="author_id"
                type="text"
                name="author_id"
                value="{{ $book->author_id }}"
            >
            <input
                id="published_date"
                type="date"
                name="published_date"
                value="{{ $book->birth_date }}"
            >
            <button type="submit"> Submit </button>
        </form>
    </body>
</html>