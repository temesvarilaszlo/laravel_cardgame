@extends('layouts.main')

@section('title', $char->name)

@section('content')

    <div class="flex flex-row justify-center gap-2 mb-2">
        <a href="{{ route('characters.edit', ['character' => $char]) }}"
            class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Szerkesztés
        </a>
        <form action="{{ route('characters.destroy', ['character' => $char]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit"
                class="px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                Törlés
            </button>
        </form>
    </div>

    <div class="flex flex-row flex-wrap gap-2 justify-center">
        <div
            class="w-full max-w-64 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $char->name }}</h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Védekezés
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $char->defence }}
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center ">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Támadás
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $char->strength }}
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Pontosság
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $char->accuracy }}
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center ">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Mágia
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $char->magic }}
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center ">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Enemy
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $char->enemy ? "igen" : "nem" }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        @if (!$char->enemy)

            <div
                class="w-full min-w-64 max-w-xl p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-xl mb-2 font-bold leading-none text-gray-900 dark:text-white">Mérkőzések</h5>
                <form action="{{ route('contests.store') }}?character_id={{$char->id}}" method="POST">
                    @csrf

                    <button type="submit"
                        class="px-3 py-2 mb-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                        Új mérkőzés
                    </button>
                </form>

                @if ($contests->isEmpty())
                    <p class="dark:text-white">Nincsenek mérkőzések</p>
                @else

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">Ellenfél neve</th>
                                <th scope="col" class="px-6 py-3">Helyszín</th>
                            </thead>
                            <tbody>
                                @foreach ($contests as $contest)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $contest->enemy()->first()->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $contest->place->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif
    </div>

@endsection
