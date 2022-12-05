<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailing List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div id="addForm">
                        <div class="addButton text-right ">
                            <a href="{{route('addEmails')}}">
                                <x-add-button  class="ml-3">
                                    {{ __('Add Mailing List') }}
                                 </x-add-button>
                            </a>

                            <a href="{{ !(@$trash) ? route('deletedEmails') : route('mailList')}} ">
                                <x-primary-button  class="ml-3 ">
                                    {{ !(@$trash) ? __('Deleted Mailing List') :  __('Mailing List') }}
                                 </x-primary-button>
                            </a>

                        </div>
                        <div class="mailing_list mt-8">
                            <div id="searchEmail" >
                                <label class="relative block">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                          </svg>
                                    </span>
                                    <input onkeyup=getMail(this) id="mailSearch" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search for anything..." type="text" name="search"/>
                                  </label>
                            </div>
                            <div id="ajaxTable"></div>
                            <div id="allTable">
                                @include('partials.mailList')
                            </div>
                            @if(!(@$trash))
                                <div class="mt-5 pagNumber">
                                    {{ $emails->links()}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getMail = (input) => {
               if(input.value.length > 3){
                   $.ajax({
                       method:'post',
                       url:'{{route("getSingleMail")}}',
                       data:{
                        "_token": "{{ csrf_token() }}",
                        input : input.value
                        },
                       beforeSend: ()=>{
                        //console.log('before')
                       },
                       success: (result)=>{
                        $('#allTable').hide()
                        $('.pagNumber').hide()
                        $('#ajaxTable').html(result).show()
                        changeInput()
                       }
                   })
               }
               else{
                $('#ajaxTable').hide()
                $('.pagNumber').show()
                $('#allTable').show()
               }
            }
        </script>
    @endpush
</x-app-layout>
