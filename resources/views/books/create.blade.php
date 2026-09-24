<html>
    <head>
        
    </head>
    <body>
        <h1>Create Book</h1>
        <form method="POST" action="{{ route('books.store') }}">
            @method('POST')
            @csrf
            <input
                id="title"
                type="text"
                name="title"
            >
            <input
                id="author_id"
                type="text"
                name="author_id"
            >
            <input
                id="published_date"
                type="date"
                name="published_date"
            >
            <button type="submit"> Submit </button>
        </form>
    </body>
</html>