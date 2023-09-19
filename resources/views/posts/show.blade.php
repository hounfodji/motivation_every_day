<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          @lang('Show a post')
      </h2>
  </x-slot>

  <div class="container mx-auto p-4">
      <div class="bg-white shadow-md rounded-lg p-6">
          <h3 class="text-2xl font-semibold text-gray-800 mb-4">@lang('Title')</h3>
          <p class="text-lg text-gray-700">{{ $post->title }}</p>

          <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Detail')</h3>
          <p class="text-lg text-gray-700">{{ $post->detail }}</p>

          <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('State')</h3>
          <p class="text-lg text-gray-700">
              @if($post->state)
                  La tâche a été accomplie !
              @else
                  La tâche n'a pas encore été accomplie.
              @endif
          </p>

          <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Date creation')</h3>
          <p class="text-lg text-gray-700">{{ $post->created_at->format('d/m/Y') }}</p>

          @if($post->created_at != $post->updated_at)
              <h3 class="text-2xl font-semibold text-gray-800 mt-6">@lang('Last update')</h3>
              <p class="text-lg text-gray-700">{{ $post->updated_at->format('d/m/Y') }}</p>
          @endif

          <div class="mt-8">
              <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
                  &larr; @lang('Back to Dashboard')
              </a>
          </div>
      </div>
  </div>
</x-app-layout>
