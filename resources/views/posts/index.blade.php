@extends('layouts.app')

@section('content')
    @include('posts.includes.categories')
    <div class="row inline-blocks">
        @foreach($posts as $post)
            @include('posts.includes.post')
        @endforeach
    </div>
    {!!$posts->linksUri!!}
@endsection
