<!DOCTYPE html>
<html>
    <head>
        {{-- icon --}}
        <link rel="icon" href="https://super.so/icon/dark/book.svg">

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
                background: #C4C4C4;
            }

            .atas::after {
                content: '';
                display: table;
                clear: both;
            }

            .top_nav {
                padding-left: 30px;
            }

            .fa {
                padding-top: 5px;
                color: #F4F2F2;
                
            }

            .fa:hover{
                color: #DD4A48;
            }

        </style>
    </head>

    <header>
        <div class="wrapper">
            <div class="atas">
                <div class="top_nav">
                    <a class="fa fa-chevron-circle-left fa-2x" href="/"></a>
                </div>
            </div>
        </div>
    </header>
</html>