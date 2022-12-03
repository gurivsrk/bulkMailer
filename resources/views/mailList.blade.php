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
                            <table id="allTable" class="display responsive w-full custom-table">
                                <thead>
                                    <tr>
                                        <th class="sm-hidden">Id</th>
                                        <th>Email</th>
                                        <th>type</th>
                                        <th class="sm-hidden">Status</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr class="ajaxClass {{$email->type == 'pending'? 'warning':($email->type == 'unsubscribed'? 'danger' : '')}}">
                                            <td class="sm-hidden">{{$email->id}}</td>
                                            <td class="tdEmail"  data-val= "{{$email->email}}"><input data-id="{{$email->id}}" data-type="email" type="email" name="email" class="w-full p-0 tableInput" value="{{old('email',@$email->email)}}" readonly></td>
                                            <td class="tdType" data-val="{{$email->type}}">
                                                <select class="w-full tableInput"  data-id="{{$email->id}}" data-type="type">
                                                    <option value="subscribed" {{$email->type == 'subscribed' ? 'selected' :'' }}>subscribed</option>
                                                    <option value="unsubscribed" {{$email->type == 'unsubscribed' ? 'selected' :'' }}>unsubscribed</option>
                                                    <option value="pending" {{$email->type == 'pending' ? 'selected' :'' }}>pending</option>
                                                </select>
                                            </td>
                                            <td class="sm-hidden">{{$email->status}}</td>
                                            <td class="tdcategory" data-val="{{$email->catname}}">{{$email->catname}}</td>
                                            <td>
                                                @if(!(@$trash))
                                                    <x-fa-input link="{{route('singleEmail',[$email->id])}}" :isBlank=true class="fa-paper-plane"/>
                                                    <x-fa-input link="{{route('deleteEmail',[$email->id])}}" class="fa-trash" onclick="return confirm('want to delete?')"/>
                                                @else
                                                    <x-fa-input link="{{route('restoreEmail',[$email->id])}}" class="fa-refresh" title="Restore" onclick="return confirm('want to retore?')"/>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        console.log(result)
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
