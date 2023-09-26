<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Succès!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.293 5.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 111.414-1.414L10 8.586l4.293-4.293z"
                        clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </span>
        </div>
    @endif

    <div class="container mx-auto ">
        <div class="flex justify-between">
            <div class="w-1/2 ... ">
                <!-- Tableau de citations -->
                <div class="w-1/2 pr-8">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Quotes</h3>
                    <!-- Affichage des citations paginées -->
                    <div class="container flex justify-center mx-auto">
                        <div class="flex flex-col">
                            <div class="w-full">
                                <div class="border-b border-gray-200 shadow pt-6">
                                    <table>
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-2 py-2 text-xs text-gray-500">#</th>
                                                <th class="px-2 py-2 text-xs text-gray-500">@lang('Title')</th>
                                                {{-- <th class="px-2 py-2 text-xs text-gray-500">@lang('Author')</th> --}}
                                                <th class="px-2 py-2 text-xs text-gray-500">Image</th>
                                                <th class="px-2 py-2 text-xs text-gray-500">Actions</th>
                                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($posts as $post)
                                                <tr class="whitespace-nowrap">
                                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $post->id }}</td>
                                                    <td class="px-4 py-4">{{ $post->title }}</td>
                                                    {{-- <td class="px-4 py-4">{{ $post->author }}</td> --}}
                                                    {{-- <td class="px-4 py-4">@if ($post->state) {{ __('Done') }} @else {{ __('To do') }} @endif</td> --}}
                                                    <td class="px-4 py-4">
                                                        @if ($post->image_compressed)
                                                            <img src="{{ asset('storage/' . $post->image_compressed) }}"
                                                                alt="{{ $post->title }}"
                                                                class="w-12 h-12 object-cover rounded-full">
                                                        @else
                                                            <span class="text-gray-400">Aucune image</span>
                                                        @endif
                                                    </td>
                                                    <x-link-button href="{{ route('posts.show', $post->id) }}">
                                                        @lang('Show')
                                                    </x-link-button>
                                                    <x-link-button href="{{ route('posts.edit', $post->id) }}">
                                                        @lang('edit')
                                                    </x-link-button>
                                                    <x-link-button id="delete-post-button"
                                                        onclick="event.preventDefault(); document.getElementById('destroy{{ $post->id }}').submit();">
                                                        @lang('Delete')
                                                    </x-link-button>
                                                    <form id="destroy{{ $post->id }}"
                                                        action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Afficher les liens de pagination pour les citations -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
                
            </div>
            
            <div class="w-1/2">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Histories</h3>
                <!-- Affichage des histoires paginées -->
                <div class="container flex justify-center mx-auto">
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div class="border-b border-gray-200 shadow pt-6">
                                <table>
                                    <table>
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-2 py-2 text-xs text-gray-500">#</th>
                                                <th class="px-2 py-2 text-xs text-gray-500">@lang('Title')</th>
                                                {{-- <th class="px-2 py-2 text-xs text-gray-500">@lang('Author')</th> --}}
                                                <th class="px-2 py-2 text-xs text-gray-500">Image</th>
                                                <th class="px-2 py-2 text-xs text-gray-500">Actions</th>
                                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($histories as $history)
                                                <tr class="whitespace-nowrap">
                                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $history->id }}
                                                    </td>
                                                    <td class="px-4 py-4">{{ $history->title }}</td>
                                                    {{-- <td class="px-4 py-4">{{ $history->author }}</td> --}}
                                                    <td class="px-4 py-4">
                                                        @if ($history->image_compressed)
                                                            <img src="{{ asset('storage/' . $history->image_compressed) }}"
                                                                alt="{{ $history->title }}"
                                                                class="w-12 h-12 object-cover rounded-full">
                                                        @else
                                                            <span class="text-gray-400">Aucune image</span>
                                                        @endif
                                                    </td>
                                                    <x-link-button href="{{ route('histories.show', $history->id) }}">
                                                        @lang('Show')
                                                    </x-link-button>
                                                    <x-link-button href="{{ route('histories.edit', $history->id) }}">
                                                        @lang('edit')
                                                    </x-link-button>
                                                    <x-link-button id="delete-history-button"
                                                        onclick="event.preventDefault(); document.getElementById('destroy{{ $history->id }}').submit();">
                                                        @lang('Delete')
                                                    </x-link-button>
                                                    <form id="destroy{{ $history->id }}"
                                                        action="{{ route('histories.destroy', $history->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Afficher les liens de pagination pour les histoires -->
                <div class="mt-4">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>















    <script>
        // Sélectionnez tous les boutons de suppression par leur classe
        const deleteButton = document.getElementById(
            'delete-post-button'); // Ajoutez un gestionnaire d'événement de clic à chaque bouton
        if (deleteButton) {
            deleteButton.addEventListener('click', (e) => {
                e.preventDefault();

                // Affichez une boîte de dialogue de confirmation SweetAlert2
                Swal.fire({
                    title: 'Êtes-vous sûr de vouloir supprimer ce post?',
                    text: "Cette action est irréversible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Attendez 1 seconde avant de soumettre le formulaire
                        setTimeout(() => {
                            document.getElementById('destroy' + postId).submit();
                        }, 1000000); // 1000 millisecondes (1 seconde)
                    }
                });
            });
        };
    </script>

</x-app-layout>
