@extends("layouts.app")
@section("title", "Créer une annonce")
@section("content")

<h1>Créer une annonce</h1>

<!-- Le formulaire est géré par la route "ads.store" -->
<form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">

    <!-- Le token CSRF -->
    @csrf

    <p>
        <label for="title">Titre</label><br />
        <input type="text" name="title" value="{{ old('title') }}" id="title" placeholder="Le titre de l'annonce">

        <!-- Le message d'erreur pour "title" -->
        @error("title")
    <div>{{ $message }}</div>
    @enderror
    </p>
    <p>
        <select name='category'>
            @foreach($categories as $category)
            <option name="category" value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @error("category")
    <div>{{ $message }}</div>
    @enderror
    </p>
    <p>
        <label for="picture">Pictures</label><br />
        <input type="file" name="picture" id="picture">

        <!-- Le message d'erreur pour "picture" -->
        @error("picture")
    <div>{{ $message }}</div>
    @enderror
    </p>
    <p>
        <label for="description">Description</label><br />
        <textarea name="description" id="description" lang="fr" rows="10" cols="50" placeholder="Le contenu de l'annonce">{{ old('description') }}</textarea>

        <!-- Le message d'erreur pour "description" -->
        @error("content")
    <div>{{ $message }}</div>
    @enderror
    </p>
    <p>
        <label for="location">Location</label><br />
        <input type="text" name="location" value="{{ old('location') }}" id="location" placeholder="Location">

        <!-- Le message d'erreur pour "location" -->
        @error("location")
    <div>{{ $message }}</div>
    @enderror
    </p>
    <p>
        <label for="price">Price</label><br />
        <input type="number" min="0.00" max="10000.00" step="0.01" name="price" value="{{ old('price') }}" id="price" placeholder="price">

        <!-- Le message d'erreur pour "price" -->
        @error("price")
    <div>{{ $message }}</div>
    @enderror
    </p>

    <input type="submit" name="valider" value="Valider">

</form>

@endsection