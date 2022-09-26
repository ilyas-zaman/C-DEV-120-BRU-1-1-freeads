<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Category;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //On récupère toutes les annonces
        $ads = Ad::latest()->get();
        $categories = Category::all();


        // On transmet les annonces à la vue
        return view('ads.index', ['categories' => $categories, 'ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        $ads = Ad::all();
        return view('ads.create', ['categories' => $categories, 'ads' => $ads, 'users' => $users]);
        //return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // 1. La validation
        $this->validate($request, [
            'title' => 'bail|required|string|max:255',
            "picture" => 'bail|required|image|max:1024',
            "description" => 'bail|required',
            "location" => 'bail|required|string|max:255',
            "price" => 'required',
        ]);

        // 2. On upload l'image dans "/storage/app/public/ads"
        $chemin_image = $request->picture->store("ads");



        // 3. On enregistre les informations de l'annonce
        Ad::create([
            "title" => $request->title,
            "picture" => $chemin_image,
            "description" => $request->description,
            "location" => $request->location,
            "price" => $request->price,
            "category_id" => $request->category,
            'user_id' => Auth::id(),
        ]);

        // 4. On retourne vers toutes les annonces : route("ads.index")
        return redirect(route("ads.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return view("ads.show", compact("ad"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view("ads.edit", compact("ad"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        // 1. La validation

        // Les règles de validation pour "title", "description","location" et "price"
        $rules = [
            'title' => 'bail|required|string|max:255',
            "description" => 'bail|required',
            "location" => 'bail|required|string|max:255',
            "price" => 'required',
        ];

        // Si une nouvelle image est envoyée
        if ($request->has("picture")) {
            // On ajoute la règle de validation pour "picture"
            $rules["picture"] = 'bail|required|image|max:1024';
        }

        $this->validate($request, $rules);

        // 2. On upload l'image dans "/storage/app/public/ads"
        if ($request->has("picture")) {

            //On supprime l'ancienne image
            Storage::delete($ad->picture);

            $chemin_image = $request->picture->store("ads");
        }

        // 3. On met à jour les informations de l'annonce
        $ad->update([
            "title" => $request->title,
            "picture" => isset($chemin_image) ? $chemin_image : $ad->picture,
            "description" => $request->description,
            "location" => $request->location,
            "price" => $request->price
        ]);

        // 4. On affiche l'annonce modifiée : route("ads.show")
        return redirect(route("ads.show", $ad));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        // On supprime l'image existant
        Storage::delete($ad->picture);

        // On les informations du $ad de la table "ads"
        $ad->delete();

        // Redirection route "ads.index"
        return redirect(route('ads.index'));
    }
}
