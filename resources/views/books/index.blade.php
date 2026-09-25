@extends('layouts.app')

@section('content')
<script>
        const deleteBook = async function (id) {
            response = await fetch('/api/books/' + id, {
                method: 'DELETE',
            })
        };

        const loadBooks = async function() {
            const tableBody = document.getElementById('table-body');
            const response = await fetch("/api/books")
            const books = await response.json();
            console.log(books)

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

        $(document).ready(function() {
            loadBooks();

            $('table').on('click', '.delete-btn', async function() {
                // Read the attributes
                let authorId = $(this).data('id');
                console.log("Deleting record ID:", authorId);
                await deleteBook(authorId);
                await loadBooks();
            });
        });
        
    </script>

    <div class="">
        <table class="table-fixed min-w-5xl text-sm">
            <tr>
                <th> id </th>
                <th> title </th>
                <th> publish_date </th>
                <th> created_at </th>
                <th> updated_at </th>
            </tr>
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