@if(@$name)
    <div>
        Dear {{$name}}
    </div>
@endif
{!!$msg!!}
@if(!(@$name))
    <div id="unsubscribe" >
        **Please use this link to <a href="{{url('/')}}/unsubscribe/{{base64_encode($toMail)}}" style="color:#000">unsubscribe</a> from all our emails.
    </div>
@endif
