<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Campaigns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="addForm" class="overflow-x-scroll">
                        <div class="addButton text-right">
                            <a href="{{route('sendMail')}}">
                                <x-add-button  class="ml-3">
                                    {{ __('Send Newsletter') }}
                                 </x-add-button>
                            </a>
                        </div>

                        <div class="campaigns mt-8">
                            <table id="datatable" class="display responsive">
                                <thead>
                                    <tr>
                                        <th class="sm-hidden">Id</th>
                                        <th >Subject</th>
                                        <th >From</th>
                                        <th >Category</th>
                                        <th >Created on</th>
                                        <th >Completed on</th>
                                        <th >Details</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($allCampaign as $campaign)
                                        <tr class="{{$campaign->status == 'sending'? 'warning':''}}">
                                            <td class="sm-hidden">{{$campaign->id}}</td>
                                            <td><a class="text-sky-500 font-extrabold hover:text-rose-600 transition duration-1000" href="{{route('previousCampaignsDetails',[$campaign->id])}}" target="_blank">{{$campaign->Subject}}</a></td>
                                            <td>{{$campaign->from_name}}</td>
                                            <td>{{!empty($campaign->categories_id) ? $campaign->getCategoryName($campaign->categories_id) : '-'}}</td>
                                            <td>{{$campaign->created_at}}</td>
                                            <td>{{$campaign->getCompleteTime($campaign->id)}}</td>
                                            <td class="text-center relative">
                                                @if($campaign->send_emails || $campaign->total_emails)
                                                  <div class="text-xs">{{$campaign->send_emails.'/'.$campaign->total_emails}}</div>
                                                @endif
                                                <div class="w-full {{$campaign->status == 'fail'?'bg-red-200':'bg-gray-200'}} rounded-full dark:bg-gray-700">
                                                        <div class="{{$campaign->status == 'fail'?'bg-red-600':'bg-blue-600'}} text-xs font-medium  {{ $campaign->status!='completed' ?  ($campaign->status != 'fail' ? ($campaign->getPercentage($campaign->send_emails,$campaign->total_emails) < 30 ? 'text-blue-900': 'text-blue-100') : 'text-slate-800') :'text-blue-100' }} text-center p-0.5 leading-none rounded-full" style=" {{$campaign->status=='completed' && $campaign->status != 'fail'? 'width: 100%' : 'width:'.$campaign->getPercentage($campaign->send_emails,$campaign->total_emails)}}">{{$campaign->status=='completed' ? 'completed' : ($campaign->status == 'fail' ? 'failed' :$campaign->getPercentage($campaign->send_emails,$campaign->total_emails))}}</div>
                                                </div>
                                                @if($campaign->status!='completed' && $campaign->status != 'fail')
                                                    <span class="absolute get-info" onclick="getData({'id':'{{$campaign->categories_id}}'})" >ⓘ</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-5">
                                {{ $allCampaign->links()}}
                            </div>
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
    <div id="showData" class="z-50 fixed top-0 left-0 w-full flex h-screen items-center text-white text-center justify-center bg-black/40 hidden">
        <div id="MailInfo"></div>
        <div class="ajaxData"></div>
    </div>
</x-app-layout>
