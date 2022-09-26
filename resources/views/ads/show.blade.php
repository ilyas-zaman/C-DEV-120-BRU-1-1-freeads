@extends("layouts.app")
@section("title", $ad->title)
@section("content")

<h1>{{ $ad->title }}</h1>

<img src="{{ asset('storage/ads/'.$ad->picture) }}" alt="Image de couverture" style="max-width: 300px;">
<div class="bloc annonce">
    <div> {{ $ad->location }} </div>
    <div>{{$ad->category->name}}</div>

    <div>{{ $ad->description }}</div>
    <div>{{ $ad->price }}</div>
</div>

<p><a href="{{ route('ads.index') }}" title="Retourner aux articles">Retourner aux annonces</a></p>

@endsection