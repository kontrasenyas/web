@extends('layouts.master')

@section('title')
    Feedback for {{ $user->first_name }}
@endsection

@section('content')
    Give feedback {{ $user->first_name }} {{ $user->last_name }}
@endsection