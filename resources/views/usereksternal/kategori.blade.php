<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">
        <title> Topik </title>

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
                
        <style>
            /* body {
                font-family: 'Nunito', sans-serif;
            } */

            .topikpertanyaan .judul {
                text-align: center;
                text-transform: uppercase;
                color: #D72323;
                padding-bottom: 5px; 
                font-weight: 800;
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
                font-weight: 800;
            }

            .topikpertanyaan .container {
                position: absolute;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                z-index: -1;
            }

            p {
                font-size: 18px; 
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <script>
            $(document).ready(function(){
                $('#input').keyup(function(){
                    var strcari = $('#input').val();
                    var id_kategori = $(this).attr("data-id");
                    $("#list_tanya").html('<center><p class="text-muted">Loading...</p></center>')
                        $.ajax({
                            url: "{{ URL('/kategori/{id}/get_pertanyaan') }}",
                            type: "GET",
                            data: 'name='+strcari + '&id_kategori='+id_kategori,
                            success:function(data){
                                $('#list_tanya').html(data);
                            }
                    });
                });
            });
        </script>
    </head>

    <body>
        <!-- Header -->
        @include('usereksternal.template.sidenav')

        {{-- Isi --}}
        <div class="topikpertanyaan">
            <div class="container col-8">
                <div class="row justify-content-center ">
                    @foreach ($topikkategori as $topkat)
                    {{-- <div class="{{ $topkat->id }}"> --}}
                        <h1 class="judul"> TOPIK {{ $topkat->kategori }}</h1>
                    {{-- </div> --}}
                    <div class="col-md-6">
                        <form action="" method="GET">
                            <div class="input-group mb-3">
                                <input data-id="{{ $topkat->id }}" id="input" name="input" type="text" class="form-control" placeholder=" &#xF002; search for a question..." style="font-family:'Nunito', sans-serif, FontAwesome; font-weight: 800">
                            </div>
                        </form>
                    </div>
                    @endforeach
                    <div id="list_tanya">
                        <?php $i=1;?>
                        <div class="accordion" id="accordionexample" style="border=none; border-radius: 5px;">
                            @foreach($topikpertanyaan as $tanya)
                                <div class="accordion-item" style="border: 0px solid white; padding-bottom: 15px; background-color: #DDDDDD;">
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
        </div>
    </body>
</html>