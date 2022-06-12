<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create Article') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          New Article
          <form action="{{ route('articles.store') }}" method="POST"
            class="mt-2 space-y-3">
            @csrf
            <div>
              <x-label for="title" :value="__('Title')" />
              <x-input id="title" class="block mt-1 w-full" type="text"
                name="title" required />
            </div>
            <div>
              <x-label for="article_text" :value="__('Article Text')" />
              <textarea name="article_text" id="article_text" rows="10"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
              </textarea>
            </div>


            <x-button>
              {{ __('Submit') }}
            </x-button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
