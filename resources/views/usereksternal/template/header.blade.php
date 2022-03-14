<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">

        {{-- bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        {{-- font awesome --}}
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

        {{-- font --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;376&family=Nunito:wght@700&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">

        {{-- JQuery --}}
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 

        <style>
            body {
                margin: 0;
                font-family: 'Nunito', sans-serif;
                font-size: 24px;
            }

            .atas  {
                background: #FEFBF3;
            }

            .atas::after {
                content: '';
                display: table;
                clear: both;
            }

            .logo {
                float: left;
                padding: 10px;
                padding-left: 14px;
            }

            .right {
                float: right;
                margin-left: 70px;
                padding-top: 23px;
                position: relative;
                padding-right: 14px;
            }

            .bottom_nav  {
                background: #C4C4C4;
            }

            .bottom_nav::after {
                content: '';
                display: table;
                clear: both;
            }

            .bottom_nav ul{
                /* width: 100%; */
                display: flex;
                /* justify-content: space-between; */
                align-items: right;
            }

            li {
                color: #494949;
                letter-spacing: 2px;
                font-size: 12px;
                list-style: none;
                margin-left: 30px;
                position: relative;
            }

            .bottom_nav .right a{
                color: #000000;
                font-size: 12px;
                font-family: 'Inter', sans-serif;
                text-decoration: none; 
            }

            .bottom_nav .right a:hover{
                color: #000000;
                text-decoration: none; 
            }

            .bottom_nav .right a::before {
                content: '';
                display: block;
                height: 5px;
                background-color: #D72323;

                position: absolute;
                bottom: 0;
                width: 0%;

                transition: all ease-in-out 250ms;
            }

            .bottom_nav .right a:hover::before {
                width: 100%;
            }

            .left{
                float: left;
                display: flex;
                align-items: center;
                padding-top: 9px;
                padding-left: 12px;
            }

            .search_bar input[type="text"]{
                border: 1px solid #666666;
                outline: none;
            }

            .button_bar{
                margin-left: 12px;
            }

        </style>
    </head>

    <header>
        <div class="wrapper">
            <div class="atas">
                <div class="top_nav">
                    <img src="{{ asset('image/logo.png') }}" alt="logo" class="logo" width="150px" height="87px">
                </div> 
                    <div class="right">
                        <a type="button" class="btn btn-danger btn-sm" href="{{ route('login') }}" style="font-weight: 800; font-family: 'Nunito', sans-serif;">LOGIN</a>
                    </div>
            </div>

            <div class="bottom_nav">
                <!-- <div class="left">
                    <div class="search_bar">
                        <input type="text" class="form-control" placeholder="search for a question...">
                    </div>
                    <div class="button_bar">
                        <button type="button" class="btn btn-danger btn-sm">SEARCH</button>
                    </div>
                </div>  -->
                <div class="right">
                    <ul>
                        <li><a href="/">HOME</a></li>
                        <li><a href="/contactus">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</html>