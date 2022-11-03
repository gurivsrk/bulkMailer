<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Newsletter') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="addButton text-right">
                        <a href="{{route('previousCampaigns')}}">
                            <x-add-button class="ml-3">
                                {{ __('View Previous Campaigns') }}
                            </x-add-button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('sendMailPost') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="block mt-4">
                            <x-input-label for="from_name" :value="__('From Name')" />

                            <x-text-input id="from_name" class="block mt-1 w-full" type="text" name="from_name" :value="old('from_name')" required autofocus />

                            <x-input-error :messages="$errors->get('from_name')" class="mt-2" />
                        </div>
                        <div class="block mt-4">
                            <x-input-label for="categoryName" :value="@$isSingle?__('Emails'):__('Category Name')" />
                            <select class="block mt-1 w-full {{@$isSingle ? 'select2' : 'select1'}}" name="category_name[]" multiple>
                                <option value=""> Please select an option</option>
                                @if(!(@$isSingle)) <option value="-12">All</option> @endif
                                @foreach ($categories as $category)
                                    <option value="{{@$isSingle?$category->email :$category->id}}" {{@$isSingle?'selected':''}}>{{@$isSingle? $category->email :$category->title}}</option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
                        </div>
                        <div class="block mt-4">
                            <x-input-label for="title" :value="__('Title')" />

                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>


                        <div class="block mt-4">
                            <x-input-label for="code" :value="__('Newsletter')" />
                            <x-text-area id="editor" class="ckeditor" name='newsletter' required oldValue="{{old('newsletter')}}"/>
                            <x-input-error :messages="$errors->get('newsletter')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Send') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
</x-app-layout>
