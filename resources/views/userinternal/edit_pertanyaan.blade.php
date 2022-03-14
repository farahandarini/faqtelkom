<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{-- icon --}}
        <link rel="icon" href="{{ asset('image/icon.png') }}">
        <title> Edit Pertanyaan </title>

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
        
        {{-- tinyMCE --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.5/tinymce.min.js"></script>
        
        <script>
           var editor_config = {
                selector: 'textarea.jawab',
                directionality: document.dir,
                path_absolute: "/",
                menubar: 'edit insert view format table',
                plugins: [
                    "advlist autolink lists link image charmap preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media save table contextmenu directionality",
                    "paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | formatselect styleselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen code",
                relative_urls: false,
                language: document.documentElement.lang,
                height: 300,
                file_browser_callback : function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.querySelector('body').clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.querySelector('body').clientHeight;
    
                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                    } else {
                    cmsURL = cmsURL + "&type=Files";
                    }
    
                    tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                    });
                },
            }
            tinymce.init(editor_config);
        </script>

        <style> 
            h1 {
                text-align: center;
                font-family: 'Nunito', sans-serif;
                color: #D72323;
                padding-top: 10px;
                padding-bottom: 10px; 
                margin-top: 15px;
            }          
            
            .form-group .submit {
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

            .form-group .submit:hover, .form-group .submit:focus {
                color: #070707;
                outline: 0;
                background-color: transparent;
            }

            .form-group .cancel {
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

            .form-group .cancel:hover, .form-group .cancel:focus {
                color: #B33030;
                outline: 0;
                background-color: transparent;
            }

            .invalid-feedback {
                font-size: 14px;
            }

            .alert-success{
                font-size: 16px;
            }

        </style>
    </head>

    <body>
        <!-- Header -->
        @include('userinternal.template.sidenav')

        <!-- Isi -->
        <h1>EDIT PERTANYAAN</h1>

        <div class="container col-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @foreach($pertanyaan as $tanya)
            <form action="edit/edit_proses{{$tanya->id}}" method="post">
                @csrf
                @method('patch')

                {{-- kategori --}}
                <h5>
                    KATEGORI
                </h5>
                <div class="input-group input-group-sm mb-3">
                    <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{old('kategori', $tanya->id_kategori)==$kat->id ? 'selected' : null}}>{{ $kat->kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- pertanyaan --}}
                <h5>
                    PERTANYAAN
                </h5>
                <div class="input-group input-group-sm mb-3">
                    <textarea id="text" name="pertanyaan" type="text" class="form-control @error('pertanyaan') is-invalid @enderror" aria-label="pertanyaan" aria-describedby="basic-addon1">{{ old('pertanyaan', $tanya->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- jawaban --}}
                <h5>
                    JAWABAN
                </h5>
                <div class="input-group input-group-sm mb-3">
                    <textarea id="text" name="jawaban" type="text" class="form-control @error('jawaban') is-invalid @enderror jawab" aria-label="jawaban" aria-describedby="basic-addon1" rows="4">{{ old('jawaban', $tanya->jawaban) }}</textarea>
                    @error('jawaban')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- button --}}
                <div class="form-group">
                    <div class="d-flex justify-content-center">
                        <a type="button" class="btn cancel" href="kategori{{ $tanya->id_kategori }}">CANCEL</a>
                        <button type="submit" class="btn submit">SUBMIT</button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>        
    </body>
</html>
