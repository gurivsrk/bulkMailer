<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailing List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="addForm">
                        <div class="addButton text-right">
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
                            <table id="datatable" class="display ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>type</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr class="ajaxClass {{$email->type == 'pending'? 'warning':($email->type == 'unsubscribed'? 'danger' : '')}}">
                                            <td></td>
                                            <td>{{$email->id}}</td>
                                            <td class="tdEmail"  data-val= "{{$email->email}}"><input data-id="{{$email->id}}" data-type="email" type="email" name="email" class="w-full p-0 tableInput" value="{{old('email',@$email->email)}}" readonly></td>
                                            <td class="tdType" data-val="{{$email->type}}">
                                                <select class="w-full tableInput"  data-id="{{$email->id}}" data-type="type">
                                                    <option value="subscribed" {{$email->type == 'subscribed' ? 'selected' :'' }}>subscribed</option>
                                                    <option value="unsubscribed" {{$email->type == 'unsubscribed' ? 'selected' :'' }}>unsubscribed</option>
                                                    <option value="pending" {{$email->type == 'pending' ? 'selected' :'' }}>pending</option>
                                                </select>
                                            </td>
                                            <td>{{$email->status}}</td>
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
                                <div class="mt-5">
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

    @endpush
</x-app-layout>
