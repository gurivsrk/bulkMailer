<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon"  href="{{asset('imgs/vsrk circle.png')}}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{asset('css/style.css')}}" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <div id="alert" class="bulkMailerAlert"><ul></ul></div>
    <!---- scripts ------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('/js/plugins/ckeditor')}}/ckeditor.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
    <script src="{{asset('/js/main.js')}}"></script>
     @stack('scripts')
     <script>
        const closeModel = ({dataId}) =>{
            document.getElementById(dataId).classList.add("hidden")
        }

        const changeInput = () => {
                $('.tableInput').on('change',function(){
                    if(confirm('sure to change')){
                        const id = $(this).attr('data-id'),
                        input= $(this).val(),
                        $this = $(this),
                        type = $(this).attr('data-type');
                        $.ajax({
                            type:'post',
                            url: '{{route("sendMailData")}}',
                            headers :{ 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                            data : {id, input, type},
                            success: function(result){
                                if(type == 'type'){
                                    const NewClass = input == 'pending' ? 'warning' :  ( input == 'unsubscribed'? 'danger': '' );
                                    $this.parent().parent().removeClass('warning').removeClass('danger').addClass(NewClass)
                                }

                                customAlert('alert',"updated successfully")
                            }
                        })
                    }
                })
            }
            changeInput()

            const customAlert = (id, msg ,type = 'success') =>{
                let msgArray = [], rawMsg = [], bg = '#198754'
                if(type =='errors'){
                   bg = '#dc3545'
                    rawMsg = msg.split(',')
                        rawMsg.forEach(function(err){
                            msgArray.push('<li>'+ err.replace('[','').replace(']','')+'</li>')
                        })
                        msg = msgArray
                }
                if(type == 'noitce'){
                    bg = '#ffc107'
                }
                $('#'+id+' ul').html(msg)
                $('#'+id).css({'background': bg}).fadeIn().delay(6000).fadeOut()

            }
            @if(Session::has('success'))
            customAlert('alert',"{{Session::get('success')}}")
            @endif
            @if(Session::has('noitce'))
            customAlert('alert','{!!Session::get("noitce")!!}','noitce')
            @endif
            @if(Session::has('fail'))
            customAlert('alert','{!!Session::get("fail")!!}','errors')
            @endif

     </script>
</html>
