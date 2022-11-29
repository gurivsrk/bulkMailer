<div id="partial_show_data" class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 h-auto max-h-5/6 overflow-hidden overflow-y-scroll ">
    <div class="close absolute top-0 right-0 cursor-pointer font-black text-xl" onclick="closeModel({dataId:'showData'})">X</div>
    <div class="mx-auto max-w-md">
      <div class="divide-y divide-gray-300/50">
        <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
          <ul class="space-y-4">
            @foreach($data as $d)
            <li class="flex items-center">
              <svg class="h-6 w-6 flex-none {{$d->status == 'success' ? 'fill-green-100 stroke-green-500': ($d->status == 'sending' ? 'fill-sky-100 stroke-sky-500' : 'fill-amber-100 stroke-amber-500')}}  stroke-2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="11" />
                @if($d->status == 'success')
                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                @endif
              </svg>
              <p class="ml-4">{{$d->email}} -- <span>{{$d->status}}</span></p>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
