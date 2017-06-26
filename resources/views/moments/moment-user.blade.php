@foreach($moments as $moment)
    <div class="col-md-12 form-group">
        <div class="col-md-6">
            <img src="{{ route('moment.image', ['filename' => $moment->image]) }}" alt="" class="img-responsive pull-right" width="400px" height="400px">
        </div>
        <div class="col-md-6">
            <p class="text-muted"> {{ $moment->location }}</p> 
            <p>{!! nl2br(e($moment->body)) !!}</p>
        </div>
    </div>
@endforeach

