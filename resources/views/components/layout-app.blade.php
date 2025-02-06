<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- resources -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">

        <!-- favicon -->
        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}" id="__token">
        <!-- resources -->
        {{--<link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" >
        {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        --}}
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery/jquery.mask.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://momentjs.com/downloads/moment.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- custom -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"> 
        {{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
   
        <title>{{ env('APP_NAME')}} @isset($pageTitle) - {{ $pageTitle }} @endisset</title>
      
    </head>

    <body>
        <x-user-bar />
        <x-modal-evento />
        <x-modal-evento-ver />

        <div class="d-flex pt-2">
            <div class="col-0">
                <x-side-bar/>
            </div>
            <div class="col-10">
                {{ $slot }}
            </div>
            
        </div-d-flex>

      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>

    </body>

</html>