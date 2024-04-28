@extends('layouts.main')

@section('title', 'Helyszínek')

@section('content')

    <div class="flex flex-row flex-wrap justify-center gap-2 m-2">
        @forelse ($places as $place)
        <div
            class="w-full max-w-64 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center gap-2">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $place->name }}</h5>
                <img src="{{ asset('storage/' . $place->image_hash) }}" alt="Picture of {{ $place->name }}"
                    class=" max-h-52">

                <div class="flex flex-row flex-wrap gap-2 justify-center">
                    <a href="{{ route('places.edit', ['place' => $place]) }}"
                        class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Szerkesztés
                    </a>
                    <form action="{{ route('places.destroy', ['place' => $place]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                            Törlés
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-white">Nincsenek helyszínek</p>
        @endforelse
    </div>

@endsection
