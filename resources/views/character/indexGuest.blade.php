@extends('layouts.main')

@section('title', 'Főoldal')

@section('content')

<p class="text-white">Karakterek száma: {{ $characterCount }} </p>
<p class="text-white">Mérkőzések száma: {{ $contestCount }} </p>

@endsection
