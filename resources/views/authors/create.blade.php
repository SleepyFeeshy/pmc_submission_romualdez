@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('authors.store') }}">
        @method('POST')
        @csrf
        <input
            id="name"
            type="text"
            name="name"
        >
        <input
            id="birth_date"
            type="date"
            name="birth_date"
        >
        <button type="submit"> Submit </button>
    </form>


@endsection