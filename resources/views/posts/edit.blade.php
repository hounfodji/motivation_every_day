<x-app-layout>
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

            <!-- Tâche accomplie -->
            {{-- <div class="block mt-4">
                <label for="state" class="inline-flex items-center">
                    <input id="state" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="state" @if(old('state', $post->state)) checked @endif>
                    <span class="ml-2 text-sm text-gray-600">{{ __('post done') }}</span>
                </label>
            </div> --}}

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
</x-app-layout>
