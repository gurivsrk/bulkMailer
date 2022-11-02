<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="{{asset('/js/main.js')}}"></script>
    <script>
        $(document).ready(function(){
            const alert = (id, msg ,type = 'success') =>{
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
                alert('alert',"{{Session::get('success')}}")
            @endif
            @if(Session::has('noitce'))
                alert('alert','{!!Session::get("noitce")!!}','noitce')
            @endif
            @if(Session::has('fail'))
                alert('alert','{!!Session::get("fail")!!}','errors')
            @endif
        })
    </script>
</html>
