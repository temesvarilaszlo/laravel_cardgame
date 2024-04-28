<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $this->authorize('viewAny', Place::class);

            $places = Place::all();
            return view('place.places', ['places' => $places]);
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $this->authorize('create', Place::class);

            return view('place.place_form');
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
        try{
            $this->authorize('create', Place::class);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'image' => 'required|file|mimes:png,jpg,jpeg'
            ], [
                'image.mimes' => 'The :attribute field must be a file of type: jpeg, png, jpg.'
            ]);

            $validatedData = $validator->validated();

            $image_name = $request->file('image')->getClientOriginalName();
            $image_hash = $request->file('image')->store('place_images');
            $validatedData['image'] = $image_name;
            $validatedData['image_hash'] = $image_hash;

            Place::create($validatedData);

            return redirect()->route('places.index');
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        return redirect()->route('places.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        try{
            $this->authorize('update', $place);

            return view('place.place_form', ['place' => $place]);
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        try{
            $this->authorize('update', $place);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'image' => 'nullable|file|mimes:png,jpg,jpeg'
            ], [
                'image.mimes' => 'The :attribute field must be a file of type: jpeg, png, jpg.'
            ]);

            $validatedData = $validator->validated();

            $validatedData['image'] = $place->image;

            if ($request->hasFile('image')){
                $old_image_hash = $place->image_hash;
                Storage::delete($old_image_hash);

                $image_name = $request->file('image')->getClientOriginalName();
                $image_hash = $request->file('image')->store('place_images');
                $validatedData['image'] = $image_name;
                $validatedData['image_hash'] = $image_hash;
            }

            $place->update($validatedData);

            return redirect()->route('places.index');
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        try{
            $this->authorize('delete', $place);

            Storage::delete($place->image_hash);
            $place->contests()->delete();
            $place->delete();

            return redirect()->route('places.index');
        }
        catch(AuthorizationException $e){
            abort(403, 'Unauthorized action');
        }
    }
}
