@extends('layouts.app')

@section('body-class','messenger-page')
@section('content')
    <mi-chat :user="{{ auth()->user() }}" :initial_contacts="{{$contacts}}"></mi-chat>
@endsection
