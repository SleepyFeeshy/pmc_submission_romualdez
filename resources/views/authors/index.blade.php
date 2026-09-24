@extends('layouts.app')

@section('content')
    <table>
        <tr>
            <th> id </th>
            <th> name </th>
            <th> birth_date </th>
            <th> created_at </th>
            <th> updated_at </th>
        </tr>
        @foreach ($authors as $author)
        <tr>
            <td>{{ $author->id }} </td>
            <td>{{ $author->name }} </td>
            <td>{{ $author->birth_date }} </td>
            <td>{{ $author->created_at }} </td>
            <td>{{ $author->updated_at }} </td>
        </tr>
        @endforeach
    </table>
    <a href="/authors/create">Add author</a>
@endsection