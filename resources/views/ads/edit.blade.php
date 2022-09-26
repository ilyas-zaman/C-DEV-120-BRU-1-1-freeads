@extends("layouts.app")
@section("title", "Editer un post")
@section("content")

<h1>Editer une annonce</h1>

<!-- Si nous avons une annonce $ad -->
@if (isset($ad))

<!-- Le formulaire est géré par la route "ads.update" -->
<form method="POST" action="{{ route('ads.update', $ad) }}" enctype="multipart/form-data">

	<!-- <input type="hidden" name="_method" value="PUT"> -->
	@method('PUT')

	@else

	<!-- Le formulaire est géré par la route "posts.store" -->
	<form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">

		@endif

		<!-- Le token CSRF -->
		@csrf

		< <p>
			<label for="title">Titre</label><br />

			<!-- S'il y a un $ad->title, on complète la valeur de l'input -->
			<input type="text" name="title" value="{{ isset($ad->title) ? $ad->title : old('title') }}" id="title" placeholder="Le titre de l'annonce">

			<!-- Le message d'erreur pour "title" -->
			@error("title")
			<div>{{ $message }}</div>
			@enderror
			</p>

			<!-- S'il y a une image $ad->picture, on l'affiche -->
			@if(isset($ad->picture))
			<p>
				<span>Couverture actuelle</span><br />
				<img src="{{ asset('public/storage/ads/'.$ad->picture) }}" alt="image actuelle" style="max-height: 200px;">
			</p>
			@endif

			<p>
				<label for="picture">Couverture</label><br />
				<input type="file" name="picture" id="picture">

				<!-- Le message d'erreur pour "picture" -->
				@error("picture")
			<div>{{ $message }}</div>
			@enderror
			</p>
			<p>
				<label for="description">Description</label><br />

				<!-- S'il y a un $ad->decription, on complète la valeur du textarea -->
				<textarea name="description" id="description" lang="fr" rows="10" cols="50" placeholder="La descritpion de l'annonce">{{ isset($ad->description) ? $ad->description : old('description') }}</textarea>

				<!-- Le message d'erreur pour "description" -->
				@error("content")
			<div>{{ $message }}</div>
			@enderror
			</p>

			<p>
				<label for="location">Location</label><br />

				<!-- S'il y a un $ad->location, on complète la valeur de l'input -->
				<input type="text" name="location" value="{{ isset($ad->location) ? $ad->location : old('location') }}" id="location" placeholder="La location de l'annonce">

				<!-- Le message d'erreur pour "location" -->
				@error("title")
			<div>{{ $message }}</div>
			@enderror
			</p>

			<p>
				<label for="price">Price</label><br />

				<!-- S'il y a un $ad->title, on complète la valeur de l'input -->
				<input type="number" min="0.00" max="10000.00" step="0.01" name="price" value="{{ isset($ad->price) ? $ad->price : old('price') }}" id="price" placeholder="Le prix">

				<!-- Le message d'erreur pour "price" -->
				@error("title")
			<div>{{ $message }}</div>
			@enderror
			</p>

			<input type="submit" name="valider" value="Valider">

	</form>

	@endsection