<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Mailing List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="addForm">
                        <div class="addButton text-right">
                            <a href="{{route('mailList')}}">
                                <x-add-button class="ml-3">
                                    {{ __('View List') }}
                                </x-add-button>
                            </a>
                        </div>

                        <form method="post"  id="add-form" action="{{route('forms.store.bulk')}}" enctype="multipart/form-data">
                            <h4 class="card-title mb-4">Add Attachment with proper name as mentioned in mailing list { Bulk 20 at max}</h4>
                                @csrf
                                <div class="block mt-4  w-full px-1">
                                    <x-input-label for="name" :value="__('Attachments')" />
                                    <input type="file" name="files[]" id="files" multiple  accept="application/pdf"  required/>
                                </div>
                                <div class="mt-4 ">
                                    <x-input-label for="categoryName" :value="__('Category Name')" />
                                    <select class="block mt-1 w-full select2" name="category_name">
                                        <option value=""> Please select an option or add new</option>
                                       @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                       @endforeach
                                      </select>

                                    <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
                                </div>

                                <div class="flex items-center  justify-end mt-4">
                                    <x-primary-button class="ml-3">
                                        {{ __('Submit') }}
                                    </x-primary-button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
