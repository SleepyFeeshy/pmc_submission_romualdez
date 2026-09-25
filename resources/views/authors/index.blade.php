@extends('layouts.app')

@section('content')
    <script>
        const deleteAuthor = async function (id) {
            response = await fetch('/api/authors/' + id, {
                method: 'DELETE',
            })
        };

        const loadAuthors = async function() {
            const tableBody = document.getElementById('table-body');
            const response = await fetch("/api/authors")
            const authors = await response.json();

            tableBody.innerHTML = "";
            authors.forEach(function(author) {
                const row = 
                `
                    <tr class="odd:bg-white even:bg-slate-50">
                        <td class="py-2 px-1 font-mono">${author.id} </td>
                        <td>${author.name} </td>
                        <td class="font-mono text-gray-500">${author.birth_date} </td>
                        <td class="font-mono text-gray-500">${author.created_at} </td>
                        <td class="font-mono text-gray-500">${author.updated_at} </td>
                        <td> 
                            <a class="text-sm" href="api/authors/${author.id}/show"> View </a> 
                            <a class="text-sm" href="api/authors/${author.id}/edit"> Edit </a>
                            <button class="delete-btn font-sm p-1 rounded-sm bg-red-700 hover:bg-red-800 text-white font-semibold hover:cursor-pointer" data-id="${author.id}"> Delete </button>
                        </td>
                    </tr>
                `
                tableBody.insertAdjacentHTML('beforeend', row);
            })
        };

        $(document).ready(function() {
            loadAuthors();

            $('table').on('click', '.delete-btn', async function() {
                // Read the attributes
                let authorId = $(this).data('id');
                console.log("Deleting record ID:", authorId);
                await deleteAuthor(authorId);
                await loadAuthors();
            });
        });
        
    </script>
    <table id="table-body">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> birth_date </th>
            <th> created_at </th>
            <th> updated_at </th>
            <th> Actions </th>
        </tr>
        <div>
        </div >
        {{-- @foreach ($authors as $author)
        <tr>
            <td>{{ $author->id }} </td>
            <td>{{ $author->name }} </td>
            <td>{{ $author->birth_date }} </td>
            <td>{{ $author->created_at }} </td>
            <td>{{ $author->updated_at }} </td>
            <td> 
                <a class="text-sm" href="{{ route('authors.show', $author->id) }}"> View </a> 
                <a class="text-sm" href="{{ route('authors.edit', $author->id) }}"> Edit </a>
                <a class="text-sm" href="{{ route('authors.destroy', $author->id) }}"> Delete </a>
            </td>
        </tr>
        @endforeach --}}
    </table>
    <a href="/authors/create">Add author</a>
@endsection