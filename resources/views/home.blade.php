@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('content')
@include('includes.search')

@include('posts.latest-posts')

@endsection