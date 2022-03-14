<!DOCTYPE html>
<html>
    <head>
        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">

        {{-- fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

        {{-- JQuery --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <style>
            body {
                margin: 0;
                font-family: 'Nunito', sans-serif;
                font-size: 24px;
            }

            .bg-dark{
                min-height: 100vh; 
                background-size: cover; 
                /* height: 1024px;
                width: 1440px; */
                /* background-attachment: fixed; */
                background-image: url('image/bg.jpg');
                background-repeat: no-repeat;
            }

            .shadow{
                background-color: #EEEEEE;
                opacity: 0.9;
                filter: alpha(opacity=90);
            }

            .card-title{
                color: #B33030;
                padding-bottom: 15px;
                padding-top: 10px;
                font-size: 30px;
            }

            .form-group .login {
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
                font-size: 1rem;
                margin-right: 5px;
                text-decoration: none;
                text-align: center;
                text-transform: uppercase;
            }

            .form-group .login:hover, .form-group .login:focus {
                color: #B33030;
                outline: 0;
                background-color: transparent;
            }

            .form-group .cancel {
                box-sizing: border-box;
                -webkit-appearance: none;
                    -moz-appearance: none;
                        appearance: none;
                background-color: #97BFB4;
                border: 2px solid #97BFB4;
                border-radius: 0.5em;
                color: #070707;
                cursor: pointer;
                display: flex;
                align-self: center;
                font-size: 1rem;
                margin-left: 5px;
                text-decoration: none;
                text-align: center;
                text-transform: uppercase;
            }

            .form-group .cancel:hover, .form-group .cancel:focus {
                color: #070707;
                outline: 0;
                background-color: transparent;
            }
        </style>
        
    </head>

    <body>
        {{-- header --}}
        {{-- @include('template.headerlogin') --}}

        <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="">
            <div class="container-fluid">
                <div class="row  justify-content-md-center align-items-center d-flex-row text-center h-100">
                    <div class="col-12 col-md-4 col-lg-3   h-50 ">
                        <div class="card shadow">
                            <div class="card-body mx-auto">
                                <img src="{{ asset('image/logo.png') }}" alt="logo" class="logo" width="150px" height="87px">
                                <h4 class="card-title mt-3 text-center">Selamat Datang!</h4>
                                <form method="POST" action="{{ route('login') }}">

                                    @csrf

                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    {{-- NIK --}}
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="text" type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="NIK" aria-label="nik" aria-describedby="basic-addon1">
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- password --}}
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" aria-label="Username" aria-describedby="basic-addon1" placeholder="Password" name="password" >
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                    {{-- role --}}
                                    {{-- <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect01">
                                            <i class="fas fa-user-tag"></i>
                                        </label>
                                        <select class="form-select" id="inputGroupSelect01">
                                            <option selected>Choose...</option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div> --}}

                                    {{-- button --}}
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn login">{{ __('LOGIN') }}</button>
                                            <a type="submit" class="btn cancel" href="/">CANCEL</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
    </body>
</html>