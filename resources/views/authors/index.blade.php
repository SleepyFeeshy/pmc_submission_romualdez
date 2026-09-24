@extends('layouts.app')

@section('content')
    <script>
        const loadAuthors = async function() {
            const tableBody = document.getElementById('table-body');
            const response = await fetch("/api/authors")
            const authors = await response.json();

            authors.forEach(function(author) {
                const row = 
                `
                    <tr>
                        <td>${author.id} </td>
                        <td>${author.name} </td>
                        <td>${author.birth_date} </td>
                        <td>${author.created_at} </td>
                        <td>${author.updated_at} </td>
                        <td> 
                            <a class="text-sm" href=""> View </a> 
                            <a class="text-sm" href=""> Edit </a>
                            <a class="text-sm" href=""> Delete </a>
                        </td>
                    </tr>
                `
                tableBody.insertAdjacentHTML('beforeend', row);
            })
        };
        $(document).ready(loadAuthors);
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