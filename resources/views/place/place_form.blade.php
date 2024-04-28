@extends('layouts.main')

@section('title', isset($place) ? $place->name : 'Új helyszín')

@section('content')

    <div class="mx-auto w-full min-w-64 max-w-96 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ isset($place) ? route('places.update', ['place' => $place]) : route('places.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($place)
                @method('patch')
            @endisset
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                    {{ isset($place) ? $place->name . ' módosítása' : 'Új helyszín'}}
                </h5>
            </div>

            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex flex-col">
                            <label for="name" class="dark:text-white">Név</label>
                            <input type="text" placeholder="Név" name="name" id="name"
                                class="text-white rounded bg-slate-700 p-1"
                                value="{{ old('name', $place->name ?? '') }}">
                            @error('name')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                            Kép {{ isset($place) ? 'módosítása' : 'feltöltése' }}
                        </label>
                        <input name="image"
                            class="block w-full text-sm p-1 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                        @error('image')
                            <div class="label">
                                <span class="label-text-alt text-red-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </li>
                </ul>
                <button type="submit" class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Mentés</button>
        </form>
    </div>

@endsection
