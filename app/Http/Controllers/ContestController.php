<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('characters.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('characters.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->query('character_id'));
        $character_id = $request->query('character_id');
        $character = Character::all()->where('id', $character_id)->first();
        if ($character->enemy){
            return redirect()->route('characters.show', ['character' => $character]);
        }

        $enemy_id = Character::all()->where('enemy', true)->random()->id;
        $place_id = Place::all()->random()->id;

        Contest::create([
            'user_id' => Auth::user()->id,
            'place_id' => $place_id,
            'win' => null,
            'history' => [],
        ])
        ->characters()
        ->attach($character_id, [
            'enemy_id' => $enemy_id
        ]);

        return redirect()->route('characters.show', ['character' => $character]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contest $contest)
    {
        return redirect()->route('characters.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contest $contest)
    {
        return redirect()->route('characters.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contest $contest)
    {
        return redirect()->route('characters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contest $contest)
    {
        return redirect()->route('characters.index');
    }
}
