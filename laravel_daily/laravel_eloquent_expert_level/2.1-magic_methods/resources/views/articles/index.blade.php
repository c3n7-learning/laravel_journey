<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Articles') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col space-y-1">

      @foreach ($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            {{ $article->title }}

            <p class="text-gray-600">
              {{ $article->article_text }}
            </p>
          </div>
        </div>
      @endforeach

      {{ $articles->links() }}

    </div>
  </div>
</x-app-layout>
