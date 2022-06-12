<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Articles') }}
      </h2>
      <a href="{{ route('articles.create') }}"
        class="py-1 px-3 bg-gray-800 rounded text-white text-sm font-semibold">
        Add
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col space-y-1">

      @foreach ($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            {{ $article->title }} - {{ $article->random_title }}

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
