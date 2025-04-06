<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <!--   { __("TO DO form to posts") }} -->
                  {{--@dump($errors->get('message'))--}}
                  <form method="POST" action="{{route('posts.update', $post->id)}}">
                    @method('PATCH')
                    @csrf
                    <div>Titulo </div>
                    <textarea name="message"
                              class="block w-full rounded-md border-gray-300 bg-white shadow-sm
                              @error('message') border-red-300
                                  
                              @enderror focus:border-indigo-200 focus:ring 
                              focus:ring-yellow-200 focus:ring-opacity-50 dark: border-gray-600 dark:bg-gray-800 dark:text-white 
                              dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                              placeholder="{{__('What\'s do you think?')}}"
                    >{{old('message', $post->message)}}</textarea>
                   {{-- <input type="text" value="{{old('nombredelcampo')}}">--}}

                    {{-- Metodo para ver errores con TAILWIND --}}
                    <x-input-error :messages="$errors->get('message')"/>
                    <x-primary-button class="mt-6">
                        {{ __('posting') }}
                    </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>