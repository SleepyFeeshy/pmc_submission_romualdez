@extends('layouts.app')

@section('content')   
<h1> {{ $author->name }}</h1>
<h1> {{ $author->birth_date }}</h1>
@endsection