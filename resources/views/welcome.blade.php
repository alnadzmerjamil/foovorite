<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Buddyz Food Delivery</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            body {
                background-color: white;
                font-family: 'Nunito', sans-serif;
                
            }
            .main-container,.mini-container{
                width: 100%;
            }
            .header{
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: flex-start;
            }
            .div-img-motor{
                width: 70%;
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;
               
            }
            .img-motor{
                width: 35%;
                margin-right: 5px;
            }
            .str-welcome{
                width: 60%;
                font-size: 25px;
                color: rgb(73, 72, 72);
            }
            .div-login-logout{
                width: 30%;
                text-align: right;
                padding: 5px 10px;
            }
            .div-login-logout a{
                font-size:12px;
                color: black;
               

            }
            .mini-display{
                width: 100%;
                margin: auto;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-evenly;
                align-items: center;
                border-top: 1px solid gray;
                padding: 10px;

            }
            .div-for-img{
                width: 40%;
                border-radius: 5px;
                overflow: hidden;
                padding: 5px;
                margin-bottom: 10px;
            }
            .img-4{
                width: 100%;
                height: 100px;
                border-radius: 5px;
            }

            @media only screen and (min-width:768px) and (max-width:991px){
                .div-img-motor{
                width: 30%;
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;
               
            }
            .img-motor{
                width: 35%;
                margin-right: 5px;
            }
            .str-welcome{
                width: 60%;
                font-size: 30px;
                color: rgb(73, 72, 72);
            }
            .div-login-logout a{
                font-size:15px;
                text-decoration: none;

            }
            .mini-display{
                width: 100%;
                margin: auto;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-evenly;
                align-items: center;
                border-top: 1px solid gray;
                padding: 10px;

            }
            .div-for-img{
                width: 30%;
                border-radius: 5px;
                overflow: hidden;
                padding: 5px;
                margin-bottom: 10px;
            }
            .img-4{
                width: 100%;
                height: 200px;
                border-radius: 5px;
            }
            }

            @media only screen and (min-width:992px){
                .div-img-motor{
                width: 30%;
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;
               
            }
            .img-motor{
                width: 35%;
                margin-right: 5px;
            }
            .str-welcome{
                width: 60%;
                font-size: 30px;
                color: rgb(73, 72, 72);
            }
            .div-login-logout{
                padding: 20px 10px;
                
            }
            .div-login-logout a{
                font-size:15px;
            }
            
            .mini-display{
                width: 100%;
                margin: auto;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-evenly;
                align-items: center;
                border-top: 1px solid gray;
                padding: 10px;

            }
            .div-for-img{
                width: 30%;
                border-radius: 5px;
                overflow: hidden;
                padding: 5px;
                margin-bottom: 10px;
            }
            .img-4{
                width: 100%;
                height: 200px;
                border-radius: 5px;
            }
            }
        </style>
    </head>
    <body class="">
        <div class="main-container">
            <div class="mini-container">
                <div class="header">
                    <div class="div-img-motor">
                        <img class="img-motor" src="https://static.vecteezy.com/system/resources/previews/000/505/753/original/vector-scooter-icon-design.jpg" alt="">
                        <Strong class="str-welcome">Hello, Welcome!</Strong>
                    </div>
                    @if (Route::has('login'))
                        <div class="div-login-logout">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
              
                <div class="mini-display">
                    <div class="div-for-img">
                        <img src="https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/publications/food-beverage-nutrition/beveragedaily.com/article/2017/11/14/christmas-soft-drink-demand-set-to-soar-britvic/7541461-1-eng-GB/Christmas-soft-drink-demand-set-to-soar-Britvic_wrbm_large.jpg" class="img-4" alt="">
                    </div>
                    <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/R7190c03d028940b95bd508ca5e31f8ac?rik=VeDCjsmMzgqCsg&riu=http%3a%2f%2fwww.buzzle.com%2fimages%2fhealth%2fstuffy-nose%2forange-juice.jpg&ehk=LAccqqTXkx4C2auqEm6ueW6k3hnee%2bJAf0b2mYNuml4%3d&risl=&pid=ImgRaw" class="img-4" alt="">
                    </div>

                    <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/Rfff1b6111fe664bd0cf9776dceda98ef?rik=AqmRfVES1kiL8A&riu=http%3a%2f%2fphilnews.ph%2fwp-content%2fuploads%2f2019%2f07%2fsoftdrinks.jpg&ehk=lb7yapuhmNC31RMXotC5uFdT4JDZQMf9uRxu6Xjn7LU%3d&risl=&pid=ImgRaw" class="img-4" alt="">
                    </div>
                     <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/R94b6277fcec82573d9a85558cb20990e?rik=Ez2EpL2DTa%2fM4A&riu=http%3a%2f%2fhipnewjersey.com%2fwp-content%2fuploads%2f2016%2f07%2fFRIED-CHICKEN.jpg&ehk=y9UdLuEc2w4XgbPBv2vVkiMtAm96ekujp8Z46bnSMkw%3d&risl=&pid=ImgRaw" class="img-4" alt="">
                    </div>
                    <div class="div-for-img">
                        <img src="https://www.wikihow.com/images/4/44/Cook-Rice-with-Chicken-Broth-Intro.jpg" class="img-4" alt="">
                    </div>
                     <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/OIP.TmNZdGz_ss5EMwk37M2pngHaE8?pid=ImgDet&rs=1" class="img-4" alt="">
                    </div>
                     
                </div>
                
            </div>
        </div>
        
    </body>
    {{-- <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-white dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="div-img-motor">
                    <img class="img-motor" src="https://static.vecteezy.com/system/resources/previews/000/505/753/original/vector-scooter-icon-design.jpg" alt="">

                    <Strong class="str-welcome">Hello, Welcome!</Strong>
                </div>
                <hr>
                <div class="mini-display">
                    <div class="div-for-img">
                        <img src="https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/publications/food-beverage-nutrition/beveragedaily.com/article/2017/11/14/christmas-soft-drink-demand-set-to-soar-britvic/7541461-1-eng-GB/Christmas-soft-drink-demand-set-to-soar-Britvic_wrbm_large.jpg" class="img-4" alt="">
                    </div>
                    <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/R7190c03d028940b95bd508ca5e31f8ac?rik=VeDCjsmMzgqCsg&riu=http%3a%2f%2fwww.buzzle.com%2fimages%2fhealth%2fstuffy-nose%2forange-juice.jpg&ehk=LAccqqTXkx4C2auqEm6ueW6k3hnee%2bJAf0b2mYNuml4%3d&risl=&pid=ImgRaw" class="img-4" alt="">
                    </div>

                    <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/Rfff1b6111fe664bd0cf9776dceda98ef?rik=AqmRfVES1kiL8A&riu=http%3a%2f%2fphilnews.ph%2fwp-content%2fuploads%2f2019%2f07%2fsoftdrinks.jpg&ehk=lb7yapuhmNC31RMXotC5uFdT4JDZQMf9uRxu6Xjn7LU%3d&risl=&pid=ImgRaw" class="img-4" alt="">
                    </div>
                     <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/R94b6277fcec82573d9a85558cb20990e?rik=Ez2EpL2DTa%2fM4A&riu=http%3a%2f%2fhipnewjersey.com%2fwp-content%2fuploads%2f2016%2f07%2fFRIED-CHICKEN.jpg&ehk=y9UdLuEc2w4XgbPBv2vVkiMtAm96ekujp8Z46bnSMkw%3d&risl=&pid=ImgRaw" class="img-4" alt="">
                    </div>
                    <div class="div-for-img">
                        <img src="https://www.wikihow.com/images/4/44/Cook-Rice-with-Chicken-Broth-Intro.jpg" class="img-4" alt="">
                    </div>
                     <div class="div-for-img">
                        <img src="https://th.bing.com/th/id/OIP.TmNZdGz_ss5EMwk37M2pngHaE8?pid=ImgDet&rs=1" class="img-4" alt="">
                    </div>
                     
                </div>
                
            </div>
        </div>
        
    </body> --}}
</html>
