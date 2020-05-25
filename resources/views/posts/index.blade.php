@extends('layouts.app')

@section('content')
    @include('posts.includes.categories')
    <posts-list></posts-list>
@endsection
