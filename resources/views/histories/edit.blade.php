<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a history') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex">
                <!-- Colonne de gauche pour les champs -->
                <div class="w-2/3 pr-8">
                    <form action="{{ route('histories.update', $history->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <!-- Titre -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />

                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $history->title)" required autofocus />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Détail -->
                        <div class="mt-4">
                            <x-input-label for="detail" :value="__('Detail')" />

                            <x-textarea class="block mt-1 w-full" id="detail"
                                name="detail">{{ old('detail', $history->detail) }}</x-textarea>

                            <x-input-error :messages="$errors->get('detail')" class="mt-2" />
                        </div>

                        <!-- Author -->
                        <div>
                            <x-input-label for="author" :value="__('author')" />

                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                :value="old('author', $history->author)" required autofocus />

                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <!-- Champ d'entrée pour l'image réelle -->
                        <div class="mt-4">
                            <x-input-label for="image_real" :value="__('Real Image')" />
                            <input id="image_real" type="file" class="block mt-1 w-full" name="image_real"
                                accept="image/*">
                            <x-input-error :messages="$errors->get('image_real')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
                                <x-secondary-button class="bg-primary">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                            </a>


                            <x-primary-button class="ml-3  hover:bg-green-600">
                                {{ __('Send') }}
                            </x-primary-button>
                        </div>

                </div>
                <!-- Colonne de droite pour l'image -->
                <div class="hidden">
                    <div class="flex items-center justify-center h-full">
                        @if ($history->image_real)
                            <img src="{{ asset('storage/' . $history->image_real) }}" alt="Image"
                                class="max-w-full h-auto">
                        @else
                            Aucune image
                        @endif
                    </div>
                </div>

                <!-- Colonne de droite pour l'image -->
                <div class="hidden">
                    <div class="flex items-center justify-center h-full">
                        @if ($history->image_real)
                            <img src="{{ asset('storage/' . $history->image_compressed) }}" alt="Image"
                                class="max-w-full h-auto">
                        @else
                            Aucune image
                        @endif
                    </div>


                </div>
                </form>

                <!-- Colonne de droite pour l'image -->
                <div class="w-1/3">
                    <div class="flex items-center justify-center h-full">
                        @if ($history->image_real)
                            <img src="{{ asset('storage/' . $history->image_real) }}" alt="Image"
                                class="max-w-full h-auto">
                        @else
                            Aucune image
                        @endif
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</x-app-layout>
