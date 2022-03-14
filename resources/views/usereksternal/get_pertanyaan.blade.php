<?php $i=1;?>
<div class="accordion" id="accordionexample" style="border=none; border-radius: 5px;">
    @foreach($jawaban as $tanya)
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