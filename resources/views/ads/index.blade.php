@extends("layouts.app")
@section("title", "Tous les articles")
@section("content")


<a href="/adminportal">Adminportal</a>

@auth
<a href="/myprofile">my ads</a>
@endauth


<form method="GET">
    <div id="sample-table-3">
        <label>Display as Category</label>
        <select name="category_id" id="category_id">
            <option value="0">Show All</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>

            @endforeach
        </select>

    </div>
    <input type="submit" value="Submit">
</form>



<p>
    <!-- Lien pour créer un nouvel article : "ads.edit" -->
    <a href="{{ route('ads.create') }}" title="Créer une annonce">Créer une nouvelle annonce</a>
</p>




<h1>Toutes les annonces</h1>


<div class='annonces'>

    @foreach ($ads as $ad)

    <div class="bloc_annonce">
        <div class="left">
            <div class="pic">

                <img src="{{ asset('/storage/'.$ad->picture) }}" alt="Image de couverture" style="max-width: 300px;">
                <div>{{ $ad->price }}€</div>
            </div>
        </div>
        <div class="right">
            <div class="titre">
                <div>
                    <a href="{{ route('ads.show', $ad) }}" title="Lire l'annonce">
                        {{ $ad->title }}
                    </a>
                </div>
                <div> {{ $ad->category->name }} </div>
            </div>
            <div class="description">
                {{ $ad->description }}
            </div>
            <div>
                <div> par {{ $ad->user->name }} </div>
            </div>
        </div>

    </div>









    @endforeach
</div>


@endsection


<style>
    .annonces {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;

    }

    .bloc_annonce {
        display: flex;
        justify-content: space-between;
        border: solid;
        width: 600px;
        margin-bottom: 20px;


    }

    .right {
        display: flex;
        flex-direction: column;
    }

    .left {
        display: flex;
        flex-direction: column;
    }
</style>