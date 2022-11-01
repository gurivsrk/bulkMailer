<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Previous Campaigns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="addForm">
                        <div class="addButton text-right">
                            <a href="{{route('sendMail')}}">
                                <x-add-button  class="ml-3">
                                    {{ __('Send Newsletter') }}
                                 </x-add-button>
                            </a>
                        </div>
                        <div class="mailing_list mt-8">
                            <table id="datatable" class="display ">
                                <thead>
                                    <tr>
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
                                        <tr>
                                            <td>{{$email->id}}</td>
                                            <td>{{$email->email}}</td>
                                            <td>{{$email->type}}</td>
                                            <td class="text-center">{{$email->status}}</td>
                                            <td>{{$email->catname}}</td>
                                            <td>Row 1 Data 2</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-5">
                                {{ $emails->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')


    @endpush
</x-app-layout>
