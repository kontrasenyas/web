@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('content')
@include('includes.message-block')

<div class="row">
    <div class="text-center col-md-6 col-md-offset-3">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
        </div><!-- /input-group -->
    </div>
</div>

@endsection