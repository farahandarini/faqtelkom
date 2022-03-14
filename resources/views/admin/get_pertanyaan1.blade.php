<!DOCTYPE html>
<html>
    <body>    
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
                                <a href="editpertanyaan{{ $tanya->idtanya }}" class="btn edit"><i class="fa-solid fa-pen-to-square"></i></a>
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
    </body>
</html>