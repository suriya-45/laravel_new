<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{route('ticket.store')}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-auto" type="text" name="title" :value="old('title')"  />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-area id="description" class="block mt-1 w-auto"  name="description" :value="old('description')"  />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />

                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-input-label for="attachment" :value="__('Attachment')" />
                    <x-file-input id="attachment" class="block mt-1 w-auto"  name="attachment" :value="old('attachment')"  />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />

                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-primary-button>{{ __('Submit') }}</x-primary-button>
                </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
