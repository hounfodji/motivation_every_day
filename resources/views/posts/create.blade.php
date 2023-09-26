<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a post') }}
        </h2>
    </x-slot>

    <x-posts-card>

        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Titre -->
            <div>
                <x-input-label for="title" :value="__('Title')" />

                <x-text-input  id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />

                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Détail -->
            <div class="mt-4">
                <x-input-label for="detail" :value="__('Detail')" />

                <x-textarea class="block mt-1 w-full" id="detail" name="detail">{{ old('detail') }}</x-textarea>

                <x-input-error :messages="$errors->get('detail')" class="mt-2" />
            </div>

            <!-- Author -->
            <div class="mt-4">
                <x-input-label for="author" :value="__('Author')" />

                <x-text-input  id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autofocus />

                <x-input-error :messages="$errors->get('author')" class="mt-2" />
            </div>

            <!-- Champ d'image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />

                <input id="image" type="file" name="image" accept="image/*" class="block mt-1 w-full" required />

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
