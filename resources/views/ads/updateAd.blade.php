@extends("layouts.app")
@section("content")
<!-- Le tableau pour lister les annonces -->
<table border="1">
    <thead>
        <tr>
            <th>Titre</th>
            <th colspan="2">Opérations</th>
        </tr>
    </thead>
    <tbody>
        <!-- On parcourt la collection d'Annonces-->
        @foreach ($ads as $ad)
        <tr>
            <td>
                <!-- Lien pour afficher une annonce : "ads.show" -->
                <a>{{ $ad->title }}</a>
            </td>
            <td>
                <!-- Lien pour modifier une annonce : "ads.edit" -->
                <a href="{{ route('ads.edit', $ad) }}" title="Modifier l'annonce">Modifier</a>
            </td>
            <td>
                <!-- Formulaire pour supprimer une annonce : "ads.destroy" -->
                <form method="POST" action="{{ route('ads.destroy', $ad) }}">
                    <!-- CSRF token -->
                    @csrf
                    <!-- <input type="hidden" name="_method" value="DELETE"> -->
                    @method("DELETE")
                    <input type="submit" value="x Supprimer">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection