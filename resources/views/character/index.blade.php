@extends('layouts.main')

@section('title', 'Főoldal')

@section('content')

<div class="overflow-x-auto h-96">
    <table class="table table-pin-rows">
        <thead class="text-center">
            <tr>
                <th>Név</th>
                <th>Védekezés</th>
                <th>Támadás</th>
                <th>Pontosság</th>
                <th>Mágia</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($characters as $char)
                <tr>
                    <td>{{ $char->name }}</td>
                    <td>{{ $char->defence }}</td>
                    <td>{{ $char->strength }}</td>
                    <td>{{ $char->accuracy }}</td>
                    <td>{{ $char->magic }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
