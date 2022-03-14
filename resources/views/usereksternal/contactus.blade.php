<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">
        <title> Contact Us </title>

        {{-- fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">

        {{-- JQuery --}}
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

        <!-- Bootstrap CSS -->        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            .contactus{
                font-family: 'Nunito', sans-serif;
                color: #D72323;
                text-align: center;
                padding-top: 10px;
            }

            .container{
                font-family: 'Nunito', sans-serif;
                color: #000000;
                text-align: left;
                /* padding-top: 20px; */
            }

            .tulisan{
                padding-left: 40px;
                align: center;
                padding-top: 3px;
            }

            .tulisanatas{
                font-size: 20px;
            }

            .tulisanbawah{
                font-size: 30px;
            }

            .lingkaran{
                width: 150px;
                height: 150px;
                background: #2ccada;
                border-radius: 100%;
		    }

            .container i {
                background-color: #D57E7E;
                border-radius: 50%;
                border: 1x solid grey;
            }

            hr.new {
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        @include('usereksternal.template.sidenav')

        <!-- Isi -->
        <div class="container col-8">
            <div class="contactus">
                <h1>CONTACT US</h1>
            </div>
            <table>
                <tr>
                    <td style="padding-top: 20px;">
                        <i class="fas fa-phone fa-4x"></i>
                    </td>
                    <td>
                        <div class="tulisan" style="padding-top: 20px;">
                            <div class="tulisanatas">Call Center</div>
                            <div class="tulisanbawah">147</div>
                        </div>
                    </td>
                </tr>
            </table>
            <hr class="new">
            <table>
                <tr>
                    <td>
                        <i class="far fa-envelope fa-4x"></i>
                    </td>
                    <td>
                        <div class="tulisan">
                            <div class="tulisanatas">Email</div>
                            <div class="tulisanbawah">customercare@telkom.co.id</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div style="padding-top: 10px;">
        @include('usereksternal.template.footer')
        </div>
    </body>
</html>