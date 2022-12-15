<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Campaign Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="campaign-details" class="overflow-x-scroll">
                        <div class="addButton text-right">
                            <x-add-button id="stopCampaign" class="ml-3">
                                {{ __('Stop Campaign') }}
                                </x-add-button>
                        </div>
                        <div class="newsletterPreview  my-8">
                            <div class="text-sm float-right bg-black text-white px-1 leading-6">{{$details->send_emails.'/'.$details->total_emails}}</div>
                            <div class="progress flex h-6 overflow-hidden text-xs bg-slate-200">
                                <div class="progress-bar {{$details->status == 'fail' ? 'bg-red-600': ($details->status=='completed' ? 'bg-green-600' : 'bg-cyan-600')}} text-center grid text-white place-content-center" role="progressbar" style="width: {{$details->getPercentage($details->send_emails,$details->total_emails)}}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$details->status.' ('.$details->getPercentage($details->send_emails,$details->total_emails).')' }}</div>
                            </div>
                              <div class="flex">
                                <div class="block mt-4 w-1/5 px-1">
                                    <x-input-label for="from_name" :value="__('Campaign Id')" />
                                    <x-text-input id="from_name" class="block mt-1 w-full" aria-readonly readonly type="text" name="category_name" :value="old('category_name', @$details->id)" required autofocus />
                                </div>
                                <div class="block mt-4 w-4/5 px-1">
                                    <x-input-label for="from_name" :value="__('Title')" />
                                    <x-text-input id="from_name" class="block mt-1 w-full" aria-readonly readonly type="text" name="title" :value="old('title', $details->Subject)" required autofocus />
                                </div>
                            </div>
                            <div class="flex">
                                <div class="block mt-4 w-full px-1">
                                    <x-input-label for="from_name" :value="__('Category Name')" />
                                    <x-text-input id="from_name" class="block mt-1 w-full" aria-readonly readonly type="text" name="category_name" :value="old('category_name', !empty($details->categories_id) ? $details->getCategoryName($details->categories_id) : '-')" required autofocus />
                                </div>
                                <div class="block mt-4 w-full px-1">
                                    <x-input-label for="from_name" :value="__('From Name')" />
                                    <x-text-input id="from_name" class="block mt-1 w-full" aria-readonly readonly type="text" name="from_name" :value="old('from_name', $details->from_name)" required autofocus />
                                </div>
                            </div>

                            <div class="block mt-4">
                                <x-text-area id="editor" class="ckeditor" aria-readonly readonly name='newsletter' required oldValue="{{old('newsletter',$details->newsletter)}}"/>
                            </div>
                        </div>
                        <div class="campaigns mt-8">
                            <table id="datatable" class="display responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($emails as $email)
                                    <tr class="{{$email->smtp == 'fail'?'danger':''}}">
                                        <td>
                                            @if($email->smtp != 'fail')
                                            <svg class="h-6 w-6 flex-none {{$email->smtp != 'fail' ? 'fill-green-100 stroke-green-500': ($email->status == 'fail'? 'fill-red-100 stroke-red-500':'fill-amber-100 stroke-amber-500')}}  stroke-2" stroke-linecap="round" stroke-linejoin="round">
                                              <circle cx="12" cy="12" r="11" />
                                              <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                            </svg>
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-none" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20">
                                                <path fill="red" d="M10 1.6a8.4 8.4 0 1 0 0 16.8a8.4 8.4 0 0 0 0-16.8zm4.789 11.461L13.06 14.79L10 11.729l-3.061 3.06L5.21 13.06L8.272 10L5.211 6.939L6.94 5.211L10 8.271l3.061-3.061l1.729 1.729L11.728 10l3.061 3.061z"/>
                                            </svg>
                                            @endif
                                        </td>
                                        <td>{{$email->email}}</td>
                                        <td>{{$email->smtp != 'fail' ? $email->smtp : 'Status: Fail -  Reason: '.$email->error}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-5">
                                {{ $allCampaign->links()}}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const getData = ({id}) => {
                $.ajax({
                    url:"{{route('getData')}}",
                    type:'post',
                    header: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    beforeSend: function(){
                        $('#showData').removeClass('hidden')
                       $('#showData .ajaxData').html('waiting...')
                    },
                    success: (result)=>{
                        $('#showData').removeClass('hidden')
                        $('#showData .ajaxData').html(result)
                    }
                })
            }
        </script>
    @endpush
    <div id="showData" class="fixed top-0 left-0 w-full flex h-screen items-center text-white text-center justify-center bg-black/40 hidden">
        <div id="MailInfo"></div>
        <div class="ajaxData"></div>
    </div>
</x-app-layout>
