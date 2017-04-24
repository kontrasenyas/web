@extends('layouts.master')

@section('title')
    Feedback for {{ $user->first_name }}
@endsection

@section('content')
    <div class="row">
<div class="col-md-4 col-md-offset-4 text-center">
        <h3>Give feedback to <a href="{{ route('account.profile', ['id' => $user->id]) }}"> {{ $user->first_name }} {{ $user->last_name }} </a></h3>
        <input type="hidden" class="rating"/>
        <form action="{{ route('account.feedback-post') }}" method="post">
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                <label for="comment">Comment</label>
                <textarea class="form-control" type="text" name="comment" id="comment" value="{{ Request::old('comment') }}"></textarea>
            </div>            
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Send Feedback</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
        </form>
    </div>
</div>
@endsection