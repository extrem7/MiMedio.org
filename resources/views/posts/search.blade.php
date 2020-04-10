@extends('layouts.app')

@section('content')
    <h1 class="post-name mb-4">Search results for: "{{$query}}"</h1>
    <div class="row inline-blocks">
        @foreach($posts as $post)
            @include('posts.includes.post')
        @endforeach
    </div>
    {{$posts->appends(request()->query())->links()}}
@endsection
