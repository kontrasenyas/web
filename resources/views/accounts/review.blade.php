@extends('layouts.master')

@section('title')
    Feedback for {{ $user->first_name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <h3>Give feedback to <a
                        href="{{ route('account.profile', ['id' => $user->id]) }}"> {{ $user->first_name }} {{ $user->last_name }} </a>
            </h3>
            <hr>
            @if(Auth::user())
                <input type="hidden" class="rating"/>
                <form action="{{ route('account.review-post') }}" method="post">
                    <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" type="text" name="comment" id="comment"
                                  value="{{ Request::old('comment') }}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Send
                        Feedback
                    </button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </form>
            @endif
            @if(!Auth::user())
                Please <a href="{{ route('login') }}">login</a>  or <a href="{{ route('register') }}">register</a> to
                provide a feedback to this user. Thank you.
            @endif
            <hr>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <h4>Reviews from other</h4>
            @if(count($reviews) > 0)
            @foreach($reviews as $review)
                <div class="form-group div_hover col-md-12" title="View user profile">
                    <div class="col-md-12">
                        <a href="{{ route('account.profile', ['$id' => $review->user->id]) }}"><h5><strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong></h5></a>
                    </div>
                    <div class="col-md-12">
                        <p><em>{{ $review->comment }}</em></p>
                    </div>
                </div>
            @endforeach
                @endif
            @if(count($reviews) == 0)
                <div class="col-md-12">
                    <p><em>There is no feedback for this user.</em></p>
                </div>
                @endif
        </div>
    </div>
@endsection