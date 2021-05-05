<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <style>
        .footer{
            width:100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: flex-end;
            padding: 20px;
            /* margin-top: 50px; */
            background-color: rgb(17, 51, 20); 
        }
        .foovorite-text{
            width: 100%;
            text-align: center;
            font-size: 15px;
            font-family: cursive;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid rgb(46, 70, 50);
            color: gray;
            /* background-color: white; */
        }
        span{
            font-size: 20px;
            color: rgb(160, 119, 7);
        }
        .contact{
            width: 100%;
            margin: auto;
           
        }
        .contact p{font-size: 12px;
            margin-bottom: 5px;
            color: rgb(160, 119, 7);
        }
        i{
            font-size: 15px;
            color: gray;
        }
        
        /* tab */
        @media only screen and (min-width:768px) and (max-width:991px){
            .footer{
            width:100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: flex-end;
            padding: 20px;
            /* margin-top: 50px; */
            background-color: rgb(17, 51, 20); 
        }
        .foovorite-text{
            width: 100%;
            text-align: center;
            font-size: 20px;
            font-family: cursive;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid rgb(46, 70, 50);
            color: gray;
            /* background-color: white; */
        }
        span{
            font-size: 20px;
            color: rgb(160, 119, 7);
        }
        .contact{
            width: 100%;
            /* background-color: white; */
        }
        .contact p{font-size: 12px;
            margin-bottom: 5px;
            color: rgb(160, 119, 7);
        }
        i{
            font-size: 15px;
            color: gray;
        }
        }

        /* pc */
        @media only screen and (min-width:992px){
            .footer{
            width:100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: flex-end;
            padding: 20px;
            /* margin-top: 50px; */
            background-color: rgb(17, 51, 20); 
        }
        .foovorite-text{
            width: 100%;
            text-align: center;
            font-size: 20px;
            font-family: cursive;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid rgb(46, 70, 50);
            color: gray;
            /* background-color: white; */
        }
        span{
            font-size: 20px;
            color: rgb(160, 119, 7);
        }
        .contact{
            width: 100%;
            /* background-color: white; */
        }
        .contact p{font-size: 12px;
            margin-bottom: 5px;
            color: rgb(160, 119, 7);
        }
        i{
            font-size: 15px;
            color: gray;
        }
        }
    </style>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="bg-white-100" style="min-height: 100vh">
            @livewire('navigation-menu')

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
            <div class='footer'>
                <p class="foovorite-text"><span>@</span>foovorite 2021</p>
                <div class="contact">
                    <p>
                        <i class="fab fa-facebook-square"></i> Facebook
                    </p>
                    <p>
                        <i class="far fa-envelope"></i> foovorite2021@gmail.com
                    </p>
                    <p>
                        <i class="far fa-address-card"></i> +63 933 529 8211
                    </p>

                </div>
                
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
