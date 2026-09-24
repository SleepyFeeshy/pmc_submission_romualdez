@extends('layouts.app')

@section('content')
    <div class="w-5">
        <table>
            <tr>
                <th> id </th>
                <th> title </th>
                <th> publish_date </th>
                <th> created_at </th>
                <th> updated_at </th>
            </tr>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }} </td>
                <td>{{ $book->title }} </td>
                <td>{{ $book->birth_date }} </td>
                <td>{{ $book->created_at }} </td>
                <td>{{ $book->updated_at }} </td>
            </tr>
            @endforeach
        </table>
        <a href="/books/create">Add book</a>
    </div>
@endsection