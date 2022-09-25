@extends("layout")

@section("content")
@include("partials._search")
<div>
    <h2>{{ $listing['title'] }}</h2>
    <p>{{ $listing['description'] }}</p>
</div>
@endsection