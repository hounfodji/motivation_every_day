<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Show a history')
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex">
                <!-- Colonne de gauche pour les champs -->
                <div class="w-2/3 pr-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Author')</h3>
                    <p class="text-lg text-gray-700">{{ $history->author }}</p>

                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">@lang('Title')</h3>
                    <p class="text-lg text-gray-700">{{ $history->title }}</p>

                    <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Detail')</h3>
                    <p class="text-lg text-gray-700">{{ $history->detail }}</p>

                    {{-- <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('State')</h3>
                    <p class="text-lg text-gray-700">
                        @if($history->state)
                            La tâche a été accomplie !
                        @else
                            La tâche n'a pas encore été accomplie.
                        @endif
                    </p> --}}

                    <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Date creation')</h3>
                    <p class="text-lg text-gray-700">{{ $history->created_at->format('d/m/Y') }}</p>

                    @if($history->created_at != $history->updated_at)
                        <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Last update')</h3>
                        <p class="text-lg text-gray-700">{{ $history->updated_at->format('d/m/Y') }}</p>
                    @endif
                </div>
                <!-- Colonne de droite pour l'image -->
                <div class="w-1/3">
                    @if($history->image)
                        <img src="{{ asset('storage/' . $history->image) }}" alt="Image" class="max-w-full h-auto">
                    @else
                        Aucune image
                    @endif
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
                    &larr; @lang('Back to Dashboard')
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
