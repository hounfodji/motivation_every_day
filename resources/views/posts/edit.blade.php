<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a post') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex">
                <!-- Colonne de gauche pour les champs -->
                <div class="w-2/3 pr-8">
                    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <!-- Titre -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />

                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $post->title)" required autofocus />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Détail -->
                        <div class="mt-4">
                            <x-input-label for="detail" :value="__('Detail')" />

                            <x-textarea class="block mt-1 w-full" id="detail"
                                name="detail">{{ old('detail', $post->detail) }}</x-textarea>

                            <x-input-error :messages="$errors->get('detail')" class="mt-2" />
                        </div>

                        <!-- Author -->
                        <div>
                            <x-input-label for="author" :value="__('author')" />

                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                :value="old('author', $post->author)" required autofocus />

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
                        @if ($post->image_real)
                            <img src="{{ asset('storage/' . $post->image_real) }}" alt="Image"
                                class="max-w-full h-auto">
                        @else
                            Aucune image
                        @endif
                    </div>
                </div>

                <!-- Colonne de droite pour l'image -->
                <div class="hidden">
                    <div class="flex items-center justify-center h-full">
                        @if ($post->image_real)
                            <img src="{{ asset('storage/' . $post->image_compressed) }}" alt="Image"
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
                        @if ($post->image_real)
                            <img src="{{ asset('storage/' . $post->image_real) }}" alt="Image"
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









{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a post') }}
        </h2>
    </x-slot>

    <x-posts-card>

        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <!-- Titre -->
            <div>
                <x-input-label for="title" :value="__('Title')" />

                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
            
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Détail -->
            <div class="mt-4">
                <x-input-label for="detail" :value="__('Detail')" />

                <x-textarea class="block mt-1 w-full" id="detail" name="detail">{{ old('detail', $post->detail) }}</x-textarea>
                
                <x-input-error :messages="$errors->get('detail')" class="mt-2" />            
            </div>

            <!-- Author -->
            <div class="mt-4">
                <x-input-label for="author" :value="__('Author')" />

                <x-textarea class="block mt-1 w-full" id="author" name="author">{{ old('author', $post->author) }}</x-textarea>
                
                <x-input-error :messages="$errors->get('author')" class="mt-2" />            
            </div>

           

            <!-- Champ d'entrée pour l'image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />

                <input id="image" type="file" class="block mt-1 w-full" name="image" accept="image/*">
                
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Send') }}
                </x-primary-button>
            </div>

           
        </form>

    </x-posts-card>
</x-app-layout> --}}
