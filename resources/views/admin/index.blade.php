<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">
        <title> Dashboard </title>

        {{-- fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
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
                            url: "{{ URL('admin/ambil_p') }}",
                            type: "GET",
                            data: 'nama='+strcari,
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
            
            /* h5 {
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
            }

            h1 {
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

            .accordion-button:hover,.accordion-button:focus{
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

            .accordion .accordion-header .accordion-button{
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
                text-decoration: none;
            }
            .accordion .accordion-header .accordion-button.collapsed{ border: none; }
            .accordion .accordion-header .accordion-button:before,
            .accordion .accordion-header .accordion-button.collapsed:before{
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
            .accordion .accordion-header .accordion-button.collapsed:before{
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
                /* border-top: none; */
                border-radius: 5px;
            }

            .accordion .edit {
                box-sizing: border-box;
                -webkit-appearance: none;
                    -moz-appearance: none;
                        appearance: none;
                background-color: #084594;
                border: 2px solid #084594;
                border-radius: 0.5em;
                color: #DFF6FF;
                cursor: pointer;
                display: flex;
                align-self: center;
                /* font-size: 1rem; */
                /* margin-right: 5px; */
                margin-bottom: 2.5px;
                text-decoration: none;
                text-align: center;
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
                font-size: 14px;
            }

            .accordion .edit:hover, .accordion .edit:focus {
                color: #084594;
                outline: 0;
                background-color: transparent;
            }

            .accordion .delete {
                box-sizing: border-box;
                -webkit-appearance: none;
                    -moz-appearance: none;
                        appearance: none;
                background-color: #B33030;
                border: 2px solid #B33030;
                border-radius: 0.5em;
                color: #EBD4D4;
                cursor: pointer;
                display: flex;
                align-self: center;
                /* font-size: 1rem; */
                /* margin-right: 5px; */
                /* margin-top: 10px; */
                text-decoration: none;
                text-align: center;
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
                font-size: 14px;
            }

            .accordion .delete:hover, .accordion .delete:focus {
                color: #B33030;
                outline: 0;
                background-color: transparent;
            }

            .tambah .btn-add {
                box-sizing: border-box;
                -webkit-appearance: none;
                    -moz-appearance: none;
                        appearance: none;
                background-color: #557571;
                border: 2px solid #557571;
                border-radius: 0.5em;
                color: #F7D1BA;
                cursor: pointer;
                text-decoration: none;
                text-align: center;
                font-family: 'Nunito', sans-serif;
                font-size: 14px;
                padding: 5px 5px 5px 5px;
                margin-top: 5px;
            }

            .tambah .btn-add:hover, .tambah .btn-add:focus {
                color: #557571;
                outline: 0;
                background-color: transparent;
            }

            .accordion-button .nama{
                padding-top: 5px;
                font-size: 12px;
                color: #676FA3;
            }

            .alert-success{
                font-size: 16px;
                font-family: 'Nunito', sans-serif;
            }

            .modal{
                font-family: 'Nunito', sans-serif;
            }

            .card .edit {
                box-sizing: border-box;
                -webkit-appearance: none;
                    -moz-appearance: none;
                        appearance: none;
                background-color: #084594;
                border: 2px solid #084594;
                border-radius: 0.5em;
                color: #DFF6FF;
                cursor: pointer;
                /* display: flex; */
                align-self: center;
                /* font-size: 1rem; */
                /* margin-right: 5px; */
                margin-bottom: 2.5px;
                text-decoration: none;
                text-align: center;
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
                font-size: 14px;
                z-index: 2;
                position: relative;
            }

            .card .edit:hover, .card .edit:focus {
                color: #084594;
                outline: 0;
                background-color: transparent;
            }

            .card .delete {
                box-sizing: border-box;
                -webkit-appearance: none;
                    -moz-appearance: none;
                        appearance: none;
                background-color: #B33030;
                border: 2px solid #B33030;
                border-radius: 0.5em;
                color: #EBD4D4;
                cursor: pointer;
                /* display: flex; */
                align-self: center;
                /* font-size: 1rem; */
                /* margin-right: 5px; */
                /* margin-top: 10px; */
                text-decoration: none;
                text-align: center;
                text-transform: uppercase;
                font-family: 'Nunito', sans-serif;
                font-size: 14px;
                z-index: 2;
                position: relative;
            }

            .card .delete:hover, .card .delete:focus {
                color: #B33030;
                outline: 0;
                background-color: transparent;
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        @include('admin.template.sidenav')

        <!-- kategori -->
        <h1 class="judul">TOPIK PERTANYAAN</h1>
        <div class="container mt-3 justify-content-md-center align-items-center" style="align-items: center;">
            @if (session('status_k'))
                <div class="alert alert-success" role="alert">
                    {{ session('status_k') }}
                </div>
            @endif
            <div class="row justify-content-md-center align-items-center" style="margin-top: 10px;">
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
                                    <a href="kategori{{ $kat->id }}" class="btn btn-danger stretched-link">DETAIL</a>
                                </div> 
                                <div style="padding-top: 10px;">
                                    <a href="" class="btn edit" data-bs-toggle="modal" data-bs-target="#modal_edit{{ $kat->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn delete" data-bs-toggle="modal" data-bs-target="#modal_delete{{ $kat->id }}"><i class="fa-solid fa-trash-can"></i></a>
                                </div>                       
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-4 col-sm-6 mb-3" style="text-align: center;">
                    <div class="tanya">
                        <div class="card border-primary" style="background-color: #EEEEEE; border-color: #EEEEEE;">
                            <div>
                                <i class="fa-solid fa-circle-plus fa-5x" style="color: #084594; padding-top: 10px;"></i>
                            </div>
                            <div class="card-body">
                                <div>
                                    <a href="" class="btn btn-primary stretched-link" data-bs-toggle="modal" data-bs-target="#modal_add">TAMBAH</a>
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="tambah mt-2">
                    <a href="add_p" class="btn-add">
                        <i class="fa-solid fa-plus"> </i> 
                        Tambah pertanyaan baru
                    </a>
                </div>
            
                <div id="read" style="margin-top: 10px;">
                    <?php $i=1;?>
                    <div class="accordion" id="accordionexample" style="padding-bottom: 15px;">
                        @foreach($pertanyaan as $tanya)
                            <div class="accordion-item" style="border: 0px solid white; padding-top: 3px;">
                                <div class="accordion-header" id="heading<?php echo $i; ?>">
                                    <table>
                                        <td width="1000px">
                                            <a class="accordion-button collapsed col-8" style="text-transform: uppercase; background-color: transparant;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                                Q. {{ $tanya->pertanyaan }}
                                                <div class="nama">Created by {{ $tanya->nama }} </div>                                                
                                            </a> 
                                        </td>                                        
                                        <td>
                                            <a href="edit_p{{ $tanya->idtanya }}" class="btn edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="" class="btn delete" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $tanya->idtanya }}"><i class="fa-solid fa-trash-can"></i></a>                                      
                                        </td>
                                    </table>                                                                                           
                                </div>
                                    
                                <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#accordionexample">
                                    <div class="accordion-body"> A. {!! $tanya->jawaban !!}</div>                            
                                </div>
                            </div>
                            <?php $i++; ?>                           
                        @endforeach  
                    </div>                  
                </div>
            </div>
        </div>

        {{-- pop up hapus pertanyaan --}}
        @foreach($pertanyaan as $tanya)
        <div class="modal fade" id="exampleModal{{ $tanya->idtanya }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #B33030;"><b>Hapus Pertanyaan</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin data dengan id pertanyaan {{ $tanya->idtanya }} mau dihapus?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                    <a type="button" class="btn btn-danger" href="hapus_p{{ $tanya->idtanya }}">HAPUS</a>
                </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- pop up hapus kategori --}}
        @foreach($kategori as $kat)
        <div class="modal fade" id="modal_delete{{ $kat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #B33030;"><b>Hapus Kategori</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-transform: lowercase;">
                        Apakah Anda yakin kategori {{ $kat->kategori }} mau dihapus?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                        <a type="button" class="btn btn-danger" href="hapus_k{{ $kat->id }}">HAPUS</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- pop up edit kategori --}}
        @foreach($kategori as $kat)
        <div class="modal fade" id="modal_edit{{ $kat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #B33030;"><b>Edit Kategori</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-3"> 
                        <form action="edit_k{{ $kat->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch') 
                            
                            {{-- Gambar --}}
                            <h5>
                                GAMBAR
                            </h5>  
                            <div class="input-group">
                                <label class="input-group-text" for="image">Upload</label>
                                <input type="file" class="form-control" id="image" name="image" value="{{ $kat->image, old('image') }}">
                                {{-- @if($kat->image)
                                    <small>Gambar tersimpan: {{ $kat->image }}</small>
                                @endif --}}
                            </div>
                            <small class="mb-3">Gambar tersimpan: {{ $kat->image }}</small>

                            {{-- Kategori --}}
                            <h5 class="mt-3">
                                KATEGORI
                            </h5>
                            <div class="input-group input-group-sm mb-3">
                                <input id="kategori" name="kategori" type="text" class="form-control @error('kategori') is-invalid @enderror" value="{{ $kat->kategori, old('kategori') }}" required>
                                <span class="text-danger" id="kategoriError"></span>
                            </div>
            
                            {{-- Role --}}
                            <h5>
                                ROLE
                            </h5>
                            <div class="input-group input-group-sm mb-3">
                                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" aria-label="Default select example" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($role as $user)
                                        <option value="{{ $user->id }}" {{old('role', $kat->id_role)==$user->id ? 'selected' : null}}>{{ ucfirst($user->role) }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="roleError"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary" id="submitForm">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{-- pop up add --}}
        <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #B33030;"><b>Tambah Kategori</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-3"> 
                        <form action="add_k" method="post" enctype="multipart/form-data">
                            @csrf  
                            {{-- Gambar --}}
                            <h5>
                                GAMBAR
                            </h5>  
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="image">Upload</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            {{-- Kategori --}}
                            <h5>
                                KATEGORI
                            </h5>
                            <div class="input-group input-group-sm mb-3">
                                <input id="kategori" name="kategori" type="text" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}" placeholder="" required>
                                <span class="text-danger" id="kategoriError"></span>
                            </div>
            
                            {{-- Role --}}
                            <h5>
                                ROLE
                            </h5>
                            <div class="input-group input-group-sm mb-3">
                                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" aria-label="Default select example" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($role as $user)
                                        <option value="{{ $user->id }}" {{old('role')}}>{{ ucfirst($user->role) }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="roleError"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary" id="submitForm">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Footer -->
        @include('admin.template.footer')
        
    </body>
</html>
