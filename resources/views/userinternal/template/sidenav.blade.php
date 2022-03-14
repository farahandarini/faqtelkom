<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{-- icon --}}
        <link rel="icon" href="https://super.so/icon/dark/book.svg">

        {{-- bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

        {{-- font awesome --}}
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        {{-- font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@376;400&family=Nunito:wght@700;800&display=swap" rel="stylesheet">

        {{-- JQuery --}}
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 

        <style>
            body {
                margin: 0;
                font-family: 'Nunito', sans-serif;
                background-color: #DDDDDD; 
                /* font-size: 24px; */
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

            .bottom_nav .right .nav{
                color: #000000;
                font-size: 12px;
                font-family: 'Inter', sans-serif;
                text-decoration: none; 
            }

            .bottom_nav .right .nav:hover{
                color: #000000;
                text-decoration: none; 
            }

            .bottom_nav .right .nav::before {
                content: '';
                display: block;
                height: 5px;
                background-color: #D72323;

                position: absolute;
                bottom: 0;
                width: 0%;

                transition: all ease-in-out 250ms;
            }

            .bottom_nav .right .nav:hover::before {
                width: 100%;
            }

            

            .bottom_nav .right .dropdown-toggle{
                color: #000000;
                font-size: 12px;
                font-family: 'Inter', sans-serif;
                text-decoration: none; 
            }

            .bottom_nav .right .dropdown-toggle:hover{
                color: #000000;
                text-decoration: none; 
            }

            .bottom_nav .right .dropdown-toggle::before {
                content: '';
                display: block;
                height: 5px;
                background-color: #D72323;

                position: absolute;
                bottom: 0;
                width: 0%;

                transition: all ease-in-out 250ms;
            }

            .bottom_nav .right .dropdown-toggle:hover::before {
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

            .right h4{
                padding-right: 15px;
                padding-top: 5px;
                color: #694E4E;
                font-family: 'Nunito', sans-serif;
            }

            .right .fa-regular{
                padding-right: 5px;
                /* padding-top: 3px; */
                /* font-family: 'Nunito', sans-serif; */
                font-size: 24px;
            }

            .dropdown-item{
                font-size: 12px;
                font-weight: bold;
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
                    <table>
                        <th>
                            <i class="fa-regular fa-circle-user"></i>
                        </th>
                        <th>
                            <h4>Selamat Datang, {{ Auth::user()->nama }}!</h4>
                        </th>
                        <th>
                            <a type="button" class="btn btn-danger btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                                                                                                        document.getElementById('logout-form').submit();"
                                                                                                        style="font-weight: 800; font-family: 'Nunito', sans-serif;">LOG OUT</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </th>
                    </table>
                </div>
            </div>

            <div class="bottom_nav">
                <div class="right">
                    <ul>
                        <li><a class="nav" href="index">HOME</a></li>
                        {{-- @foreach ($kategori as $item)
                        <li>
                            <a href="kategori{{ $item->id }}">
                                {{ $item->kategori }}
                            </a>
                        </li>
                        @endforeach --}}
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">TOPIK</a>
                                <div class="dropdown-menu">
                                    @foreach ($kategori as $item)
                                    <a class="dropdown-item" href="kategori{{ $item->id }}" style="text-transform: uppercase;">
                                        {{ $item->kategori }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li><a class="nav" href="contactus">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</html>