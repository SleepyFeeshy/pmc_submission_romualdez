@extends('layouts.app')

@section('content')   
<h1> {{ $book->title }}</h1>
<h1> {{ $book->author_id }}</h1>
<h1> {{ $book->published_date }}</h1>
@endsection