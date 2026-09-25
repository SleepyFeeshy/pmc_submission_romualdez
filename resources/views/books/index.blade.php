@extends('layouts.app')

@section('content')
<script>
        let allBooks = [];
        const deleteBook = async function (id) {
            response = await fetch('/api/books/' + id, {
                method: 'DELETE',
            })
        };

        const renderTable = async function(books) {
            const tableBody = document.getElementById('table-body');
            console.log(books)

            if (books.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="6" class="py-4 text-center text-gray-500">No matching authors found</td></tr>`;
                return;
            }

            tableBody.innerHTML = "";
            books.forEach(function(book) {
                const row = 
                `
                    <tr class="odd:bg-white even:bg-slate-50">
                        <td class="py-2 px-1 font-mono">${book.id} </td>
                        <td>${book.title} </td>
                        <td class="font-mono text-gray-500">${book.published_date} </td>
                        <td class="font-mono text-gray-500">${book.created_at} </td>
                        <td class="font-mono text-gray-500">${book.updated_at} </td>
                        <td class="flex gap-1"> 
                            <a class="text-sm min-w-10 text-center font-sm p-1 rounded-sm bg-blue-500 hover:bg-blue-800 text-white font-semibold hover:cursor-pointer" href="books/${book.id}"> View </a> 
                            <a class="text-sm min-w-10 text-center font-sm p-1 rounded-sm bg-blue-500 hover:bg-blue-800 text-white font-semibold hover:cursor-pointer" href="api/books/${book.id}/edit"> Edit </a>
                            <button class="delete-btn text-sm min-w-10 text-center p-1 rounded-sm bg-red-700 hover:bg-red-800 text-white font-semibold hover:cursor-pointer" data-id="${book.id}"> Delete </button>
                        </td>
                    </tr>
                `
                tableBody.insertAdjacentHTML('beforeend', row);
            })
        };

        const loadBooks = async function() {
            const response = await fetch("/api/books");
            allBooks = await response.json();
            filterAndRender();
        };

        const filterAndRender = function() {
            const searchTerm = $('#search-input').val().toLowerCase().trim();
            
            const filteredBooks = allBooks.filter(book => {
                const title = (book.title || '').toLowerCase();

                return title.includes(searchTerm);
            });

            renderTable(filteredBooks);
        };

        $(document).ready(function() {
            loadBooks();

            // Real-time search filter on input
            $('#search-input').on('keyup input', function() {
                filterAndRender();
            });

            $('table').on('click', '.delete-btn', async function() {
                // Read the attributes
                let bookId = $(this).data('id');
                console.log("Deleting record ID:", bookId);
                await deleteBook(bookId);
                await loadBooks();
            });
        });
        
    </script>

    <div class="">
        <div class="mb-4 flex justify-between items-center min-w-5xl">
            <input 
                type="text" 
                id="search-input" 
                placeholder="Search by ID, title, or published date..." 
                class="px-3 py-2 border border-gray-300 rounded-md text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <a class="p-2 rounded-sm bg-green-600 hover:bg-green-700 text-white text-sm font-semibold" href="/books/create">Add book</a>
        </div>

        <table class="table-fixed min-w-5xl text-sm">
            <thead class="text-sm font-medium text-left">
                <tr>
                    <th> id </th>
                    <th> title </th>
                    <th> publish_date </th>
                    <th> created_at </th>
                    <th> updated_at </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody >
            {{-- @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }} </td>
                <td>{{ $book->title }} </td>
                <td>{{ $book->published_date }} </td>
                <td>{{ $book->created_at }} </td>
                <td>{{ $book->updated_at }} </td>
            </tr>
            @endforeach --}}
        </table>
        <a href="/books/create">Add book</a>
    </div>
@endsection