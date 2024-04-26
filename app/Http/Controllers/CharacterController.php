<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Contest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Auth::user()->characters()->get();
        return view('character.index', ['characters' => $characters]);
    }

    public function indexGuest(){
        $characterCount = Character::all()->count();
        $contestCount = Contest::all()->count();
        return view('character.indexGuest', ['characterCount' => $characterCount, 'contestCount' => $contestCount]);
    }

    public function showEnemies(){
        $enemies = Character::all()->where('enemy', true);
        return view('character.index', ['characters' => $enemies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        try{
            $this->authorize('view', $character);

            $contests = $character->contests();
            if (!$character){
                abort(404);
            }
            return view('character.character', ['char' => $character]);
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}
