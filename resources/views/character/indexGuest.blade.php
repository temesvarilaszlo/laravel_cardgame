@extends('layouts.main')

@section('title', 'Főoldal')

@section('content')

    <div class="w-full max-w-lg p-4 mx-auto bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <p class="dark:text-white">
            A "Gladiátorok" egy körökre osztott, arcade stílusú harcolós játék, ahol egyedül vívhatsz izgalmas
            csatákat a legkeményebb ellenfelek ellen. Válaszd ki kedvenc harcosodat, használd ügyesen a képességeket és
            taktikákat, és hódítsd meg a csatatereket! Csatlakozz most, és légy te az igazi gladiátor a galaxisban!
        </p>
        <hr class="my-4">
        <p class="dark:text-white">Karakterek száma: {{ $characterCount }} </p>
        <p class="dark:text-white">Mérkőzések száma: {{ $contestCount }} </p>
    </div>

@endsection
