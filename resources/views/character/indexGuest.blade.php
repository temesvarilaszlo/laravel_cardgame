@extends('layouts.main')

@section('title', 'Főoldal')

@section('content')

<p>Karakterek száma: {{ $characterCount }} </p>
<p>Mérkőzések száma: {{ $contestCount }} </p>

@endsection
