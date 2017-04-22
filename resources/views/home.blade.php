@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('content')
@include('includes.search')
<hr>
@include('posts.latest-posts')

@endsection