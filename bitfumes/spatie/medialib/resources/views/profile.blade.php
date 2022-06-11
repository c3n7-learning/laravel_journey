<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Profile') }}
    </h2>
  </x-slot>


  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      @if (session()->has('error'))
        <div
          class="w-full text-center bg-red-50 text-red-500 p-3 rounded-lg mb-3">
          {{ session()->get('error') }}
        </div>
      @endif

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          Your Profile
          <form action="{{ route('avatar.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="space-y-3 flex flex-col items-end">
              <input type="file" name="avatar"
                class='appeareance-none border py-1 px-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm file:mr-4 file:py-2 file:px-2 file:rounded-lg file:border-0 file:font-semibold file:bg-gray-800 file:bg-opacity-80 file:text-white hover:file:bg-gray-800 active:file:scale-95 file:transition-all file:ease-out file:text-xs h-fit w-full mt-1' />

              <x-button class="w-fit">
                {{ __('Upload') }}
              </x-button>
            </div>
          </form>
        </div>
      </div>

      <div class="grid grid-cols-4 mt-6 gap-6">
        @foreach ($avatars as $avatar)
          <div
            class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:scale-105 transition-all ease-out">
            <div class=bg-white border-b border-gray-200">
              <img src="{{ $avatar->getUrl('card') }}" alt=""
                class="rounded h-72 w-full object-cover">

              <div class="p-6">
                Your Profile
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>
</x-app-layout>
