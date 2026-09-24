<htmL>
    <body>
        <h1>Editing</h1>
        <form method="PUT" action="{{ route('authors.update', $author->id) }}">
            @method('PUT')
            @csrf
            <input
                id="name"
                type="text"
                name="name"
                value={{ $author->name }}
            >
            <input
                id="birth_date"
                type="date"
                name="birth_date"
                value={{ $author->birth_date }}
            >
            <button type="submit"> Submit </button>
            </input>
        </form>
    </body>
</html>