<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">
        <title> Dashboard </title>

        {{-- fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

        {{-- JQuery --}}
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <script>
            $(document).ready(function(){
                $('#input').keyup(function(){
                    var strcari = $('#input').val();
                    $("#read").html('<center><p class="text-muted">Loading...</p></center>')
                        $.ajax({
                            url: "{{ URL('ajax') }}",
                            type: "GET",
                            data: 'name='+strcari,
                            success:function(data){
                                $('#read').html(data);
                            }
                    });
                });
            });
        </script>
        
        <style>
            p {
                font-size: 18px; 
                font-family: 'Nunito', sans-serif;
            }
            
            /* h5 {
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
            } */

            .card-title{
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
            }

            .modal-title{
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
            }

            .judul {
                text-align: center;
                font-family: 'Nunito', sans-serif;
                color: #D72323;
                padding-top: 10px;
                padding-bottom: 5px; 
                margin-top: 15px;
            }

            /* h1 {
                text-align: center;
                font-family: 'Nunito', sans-serif;
                color: #D72323;
                padding-top: 10px;
                padding-bottom: 5px; 
                margin-top: 15px;
            } */

            /* .tanya {
                padding-left: 135px;
            } */

            button:hover,button:focus{
                text-decoration: none;
                outline: none;
            }
            
            .accordion .panel{
                border: none;
                border-radius: 5px;
                box-shadow: none;
                margin-bottom: 10px;
                background: transparent;
            }
            .accordion .panel-heading{
                padding: 0;
                border: none;
                border-radius: 5px;
                background: transparent;
                position: relative;
            }
            .accordion .accordion-header button{
                display: block;
                padding: 20px 30px;
                margin: 0;
                background: rgba(0,0,0,0.4);
                font-size: 17px;
                font-weight: bold;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 1px;
                border: none;
                border-radius: 5px;
                position: relative;
                font-family: 'Nunito', sans-serif;
            }
            .accordion .accordion-header button.collapsed{ border: none; }
            .accordion .accordion-header button:before,
            .accordion .accordion-header button.collapsed:before{
                content: "\f107";
                font-family: "Font Awesome 5 Free";
                width: 30px;
                height: 30px;
                line-height: 27px;
                text-align: center;
                font-size: 25px;
                font-weight: 900;
                /* warna dropdown */
                color: #fff; 
                position: absolute;
                top: 15px;
                right: 30px;
                transform: rotate(180deg);
                transition: all .4s cubic-bezier(0.080, 1.090, 0.320, 1.275);
            }
            .accordion .accordion-header button.collapsed:before{
                color: rgba(255,255,255,0.5);
                transform: rotate(0deg);
            }
            .accordion .accordion-body{
                padding: 20px 30px;
                background: rgba(0,0,0,0.1);
                font-family: 'Nunito', sans-serif;
                font-size: 15px;
                color: #000000;
                line-height: 28px;
                letter-spacing: 1px;
                border-top: none;
                border-radius: 5px;
            }
            
        </style>
    </head>

    <body>
        <!-- Header -->
        @include('usereksternal.template.sidenav')

        <!-- kategori -->
        <h1 class="judul">TOPIK PERTANYAAN</h1>
        <div class="container mt-3 justify-content-md-center align-items-center" style="align-items: center;">
            <div class="row justify-content-md-center align-items-center">
                @foreach($kategori as $kat)
                <div class="col-md-4 col-sm-6 mb-3" style="text-align: center;">
                    <div class="tanya">
                        <div class="card border-danger" style="background-color: #EEEEEE; border-color: #EEEEEE;">
                            @if($kat->image==null)
                                <div>
                                    <img class="card-img-top" src="{{ asset('image/category.png') }}" alt="Card image cap" style="padding-top: 5px; width: 200px; height: 200px;">
                                </div>                                
                            @else
                                <div>
                                    <img class="card-img-top" src="{{ asset('/'.$kat->image) }}" alt="Card image cap" style="padding-top: 10px; width: 200px; height: 200px;">
                                </div>  
                            @endif
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title" style="text-align: center;">{{ $kat->kategori }}</h5>
                                    <!-- <a href="/" class="btn btn-danger stretched-link">DETAIL</a> -->
                                    <a href="/kategori/{{ $kat->id }}" class="btn btn-danger stretched-link">DETAIL</a>
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- pertanyaan -->
        <div class="container col-8 mt-3">
            <div class="row justify-content-center ">
                <h1 class="judul">PERTANYAAN</h1>
                <div class="col-md-6">
                    <form action="" method="GET">
                        <div class="input-group mb-3">
                            <input id="input" name="input" type="text" class="form-control" placeholder=" &#xF002; search for a question..." style="font-family:'Nunito', sans-serif, FontAwesome">
                        </div>
                    </form>
                </div>
                <div id="read">
                    <?php $i=1;?>
                    <div class="accordion" id="accordionexample">
                        @foreach($pertanyaan as $tanya)
                            <div class="accordion-item" style="border: 0px solid white; padding-bottom: 15px;">
                                <h2 class="accordion-header" id="heading<?php echo $i; ?>">
                                    <button class="accordion-button collapsed" style="text-transform: uppercase;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                        Q. {{ $tanya->pertanyaan }}
                                    </button>
                                </h2>
                                    
                                <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#accordionexample">
                                    <div class="accordion-body">A. {!! $tanya->jawaban !!}</div>                            
                                </div>
                            </div>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>   
        
        <!-- Footer -->
        {{-- <br> --}}
        @include('usereksternal.template.footer')
    </body>
</html>