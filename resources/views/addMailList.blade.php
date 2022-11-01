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
                        <form method="POST" action="{{ route('uploadeMails') }}">
                            @csrf
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="categoryName" :value="__('Category Name')" />
                                <select class="block mt-1 w-full select2" name="category_name">
                                    <option value=""> Please select an option or add new</option>
                                   @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                   @endforeach
                                  </select>

                                <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
                            </div>
                            <div class="block mt-4">
                                <x-input-label for="code" :value="__('Emails')" />
                                <x-text-area id="editor" name='emails' required oldValue="{{old('emails')}}"/>
                                <x-input-error :messages="$errors->get('emails')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
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

    @push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.4.0/codemirror.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.4.0/codemirror.css">

    <script type="text/javascript">
            var VanillaRunOnDomReady = function() {
                    var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("editor"), {
                    lineNumbers: true,/* w  w w . java 2s. c  o m*/
                    mode: "htmlmixed"
                    });
            }
            var alreadyrunflag = 0;
            if (document.addEventListener)
            document.addEventListener("DOMContentLoaded", function(){
                alreadyrunflag=1;
                VanillaRunOnDomReady();
            }, false);
            else if (document.all && !window.opera) {
            document.write('<script type="text/javascript" id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
            var contentloadtag = document.getElementById("contentloadtag")
            contentloadtag.onreadystatechange=function(){
                if (this.readyState=="complete"){
                    alreadyrunflag=1;
                    VanillaRunOnDomReady();
                }
            }
            }
            window.onload = function(){
            setTimeout("if (!alreadyrunflag){VanillaRunOnDomReady}", 0);
            }
    </script>

    @endpush
</x-app-layout>
