@extends("layout")

@section("content")
<h1>{{ $heading }}</h1>

@if (count($listings) == 0)
    <p>No listings found</p>
@endif

@foreach ($listings as $listing)
    <div>
        <h2><a href="/listing/{{ $listing['id'] }}">{{ $listing['title'] }}</a></h2>

        <p>{{ $listing['description'] }}</p>
    </div>
@endforeach
@endsection