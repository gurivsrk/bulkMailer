
{!!$subject!!}
{!!$msg!!}

<div>
    <img src="{{route('emailImage',[5])}}" alt="response">
</div>
<div id="unsubscribe" >
    Please use this link to <a href="{{route('unsubscribe',[base64_encode($toMail)])}}" style="color:#000">unsubscribe</a> from all our emails.
</div>
