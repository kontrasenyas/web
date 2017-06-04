@foreach($moments as $moment)
    <div class="col-md-12 row">
        <div class="col-md-6 text-center">
            <img src="{{ route('moment.image', ['filename' => $moment->image]) }}" alt="" class="img-responsive center-block" width="50%" height="50%">
            {{ $moment->location }}
        </div>
        <div class="col-md-6">
            {!! nl2br(e($moment->body)) !!}
        </div>
    </div>
@endforeach

