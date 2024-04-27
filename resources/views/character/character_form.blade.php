@extends('layouts.main')

@section('title', isset($char) ? $char->name : 'Új karakter')

@section('content')

    <div
        class="mx-auto w-full min-w-64 max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" action="{{ isset($char) ? route('characters.update', ['character' => $char]) : route('characters.store') }}">
            @csrf
            @isset($char)
                @method('patch')
            @endisset

            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ isset($char) ? $char->name . ' módosítása' : 'Új karakter'}}</h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex flex-col">
                            <label for="name" class="dark:text-white">Név</label>
                            <input type="text" placeholder="Név" name="name" id="name"
                                class="text-white rounded bg-slate-700 p-1 input input-bordered w-full @error('name') input-error @enderror"
                                value="{{ old('name', $char->name ?? '') }}">
                            @error('name')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex flex-col">
                            <label for="defence" class="dark:text-white">Védekezés</label>
                            <input type="text" placeholder="Védekezés" name="defence" id="defence"
                                class="text-white rounded bg-slate-700 p-1 input input-bordered w-full @error('defence') input-error @enderror"
                                value="{{ old('defence', $char->defence ?? '') }}">
                            @error('defence')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex flex-col">
                            <label for="strength" class="dark:text-white">Támadás</label>
                            <input type="text" placeholder="Támadás" name="strength" id="strength"
                                class="text-white rounded bg-slate-700 p-1 input input-bordered w-full @error('strength') input-error @enderror"
                                value="{{ old('strength', $char->strength ?? '') }}">
                            @error('strength')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex flex-col">
                            <label for="accuracy" class="dark:text-white">Pontosság</label>
                            <input type="text" placeholder="Pontosság" name="accuracy" id="accuracy"
                                class="text-white rounded bg-slate-700 p-1 input input-bordered w-full @error('accuracy') input-error @enderror"
                                value="{{ old('accuracy', $char->accuracy ?? '') }}">
                            @error('accuracy')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex flex-col">
                            <label for="magic" class="dark:text-white">Mágia</label>
                            <input type="text" placeholder="Mágia" name="magic" id="magic"
                                class="text-white rounded bg-slate-700 p-1 input input-bordered w-full @error('magic') input-error @enderror"
                                value="{{ old('magic', $char->magic ?? '') }}">
                            @error('magic')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </li>
                    @if (Auth::user()->admin)
                        <li class="py-3 sm:py-4">
                            <div class="flex flex-col">
                                <div class="flex flex-row justify-start gap-1">
                                    <label class="dark:text-white" for="enemy">Enemy</label>
                                    <input type="checkbox" name="enemy" id="enemy"
                                        class="input input-bordered @error('enemy') input-error @enderror"
                                        @checked(old('enemy') === 'on' || (isset($char) ? $char->enemy : false))>
                                </div>
                                @error('enemy')
                                    <div class="label">
                                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </li>
                    @endif
                </ul>
                @error('sum_of_attributes')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
                <button type="submit" class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Mentés</button>
            </div>
        </form>
    </div>

@endsection
