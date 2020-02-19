@extends('layouts.profile')

@section('sub-content')
    <div class="row inline-blocks">
        @foreach($posts as $post)
            @include('profile.includes.post')
        @endforeach
    </div>
    {!!$posts->linksUri!!}
@endsection
