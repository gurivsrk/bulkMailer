<div id="modelInfo-x">
    <div class="close absolute top-0 right-0 cursor-pointer font-black text-xl text-white bg-red-700 py-1 px-3 m-1" onclick="closeModel({dataId:'showData'})">X</div>
</div>
<div id="partial_show_data" class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-xl sm:rounded-lg sm:px-10 h-auto max-h-5/6 overflow-hidden overflow-y-scroll ">
    <div class="mx-auto max-w-md">
      <div class="divide-y divide-gray-300/50">
        <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
          <ul class="space-y-4">
            @foreach($data as $d)
            <li class="flex items-center">
                @if($d->status == 'success')
                  <svg class="h-6 w-6 flex-none {{$d->status == 'success' ? 'fill-green-100 stroke-green-500': ($d->status == 'sending' ? 'fill-sky-100 stroke-sky-500' :($d->status == 'fail'? 'fill-red-100 stroke-red-500':'fill-amber-100 stroke-amber-500'))}}  stroke-2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="11" />
                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                  </svg>
                @elseif ($d->status == 'fail')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-none" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20">
                  <path fill="red" d="M10 1.6a8.4 8.4 0 1 0 0 16.8a8.4 8.4 0 0 0 0-16.8zm4.789 11.461L13.06 14.79L10 11.729l-3.061 3.06L5.21 13.06L8.272 10L5.211 6.939L6.94 5.211L10 8.271l3.061-3.061l1.729 1.729L11.728 10l3.061 3.061z"/>
                </svg>
                @else
                <svg class="h-6 w-6 flex-none {{$d->status == 'success' ? 'fill-green-100 stroke-green-500': ($d->status == 'sending' ? 'fill-sky-100 stroke-sky-500' :($d->status == 'fail'? 'fill-red-100 stroke-red-500':'fill-amber-100 stroke-amber-500'))}}  stroke-2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="11" />
                </svg>
                @endif

              <p class="ml-4">{{$d->email}} -- <span>{{$d->status}}</span></p>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
