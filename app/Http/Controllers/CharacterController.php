<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Contest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\call;

class CharacterController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Auth::user()->characters()->get();
        return view('character.index', ['characters' => $characters, 'title' => 'Főoldal']);
    }

    public function indexGuest(){
        $characterCount = Character::all()->count();
        $contestCount = Contest::all()->count();
        return view('character.indexGuest', ['characterCount' => $characterCount, 'contestCount' => $contestCount]);
    }

    public function showEnemies(){
        $enemies = Character::all()->where('enemy', true);
        return view('character.index', ['characters' => $enemies, 'title' => 'Enemy-k']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $this->authorize('create', Character::class);

            return view('character.character_form');
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try{
            $this -> authorize('create', Character::class);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'defence' => 'required|integer|min:0|max:3',
                'strength' => 'required|integer|min:0|max:20',
                'accuracy' => 'required|integer|min:0|max:20',
                'magic' => 'required|integer|min:0|max:20',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validator->after(function ($validator) use ($request){
                if (($request->input('defence', 0) +
                    $request->input('strength', 0) +
                    $request->input('accuracy', 0) +
                    $request->input('magic', 0)) > 20 )
                    {
                        $validator->errors()->add('sum_of_attributes', 'A védekezés, támadás, pontosság és mágia összege nem lehet nagyobb mint 20.');
                }

                if ($request->input('enemy') !== null){
                    if ($request->input('enemy') !== 'on'){
                        $validator->errors()->add('enemy', 'Helytelen érték!');
                    }
                    else if (!Auth::user()->admin){
                        $validator->errors()->add('enemy', 'Csak admin hozhat létre enemy-t!');
                    }
                }
            });

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validatedData = $validator->validated();
            $validatedData['user_id'] = Auth::id();
            $validatedData['enemy'] = $request->input('enemy') ? true : false;

            $newCharacter = Character::create($validatedData);

            return redirect()->route('characters.show', ['character' => $newCharacter]);
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        try{
            if (!$character){
                abort(404);
            }

            $this->authorize('view', $character);

            $contests = [];
            if (!$character->enemy){
                $contests = $character->contests;
            }

            return view('character.character', ['char' => $character, 'contests' => $contests]);
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
        try{
            $this -> authorize('update', $character);
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
        return view('character.character_form', ['char' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        try{
            $this -> authorize('update', $character);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'defence' => 'required|integer|min:0|max:3',
                'strength' => 'required|integer|min:0|max:20',
                'accuracy' => 'required|integer|min:0|max:20',
                'magic' => 'required|integer|min:0|max:20',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validator->after(function ($validator) use ($request){
                if (($request->input('defence', 0) +
                    $request->input('strength', 0) +
                    $request->input('accuracy', 0) +
                    $request->input('magic', 0)) > 20 )
                    {
                        $validator->errors()->add('sum_of_attributes', 'A védekezés, támadás, pontosság és mágia összege nem lehet nagyobb mint 20.');
                }

                if ($request->input('enemy') !== null){
                    if ($request->input('enemy') !== 'on'){
                        $validator->errors()->add('enemy', 'Helytelen érték!');
                    }
                    else if (!Auth::user()->admin){
                        $validator->errors()->add('enemy', 'Csak admin hozhat létre enemy-t!');
                    }
                }
            });

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validatedData = $validator->validated();
            $validatedData['enemy'] = $request->input('enemy') ? true : false;

            $character->update($validatedData);

            return redirect()->route('characters.show', ['character' => $character]);
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        try{
            $this->authorize('delete', $character);

            $character->contests()->delete();
            $character->delete();

            return redirect()->route('characters.index');
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }
}
