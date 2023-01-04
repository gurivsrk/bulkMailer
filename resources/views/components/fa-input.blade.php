@props(['isBlank' => false])

@if($attributes['link'])
    <a href="{{$attributes['link'] ?? '#'}}" class="mx-2" {{ $isBlank ?'target="_blank"':''}}>
@else
@endif
    <i {{$attributes->merge(['class'=>'fa cursor-pointer'])}}" aria-hidden="true"></i>
@if($attributes['link'])
    </a>
@else
@endif

