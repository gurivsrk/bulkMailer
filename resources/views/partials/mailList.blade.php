<table class="display responsive w-full custom-table">
    <thead>
        <tr>
            <th class="sm-hidden">Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th class="sm-hidden">Status</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($emails as $email)
            <tr class="ajaxClass {{$email->type == 'pending'? 'warning':($email->type == 'unsubscribed'? 'danger' : '')}}">
                <td class="sm-hidden">{{$email->id}}</td>
                <td class="tdName"  data-val= "{{$email->name}}">
                    @if($email->name)
                    <input data-id="{{$email->id}}" data-type="name" type="text" name="name" class="w-full p-0 tableInput" value="{{old('email',@$email->name)}}" readonly>
                    @else
                        -
                    @endif
                </td>
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
