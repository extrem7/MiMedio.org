@extends('layouts.profile')

@section('sub-content')
    <div class="row">
        <div class="col-12">
            <div class="semi-bold blue-color medium-size mt-4 mb-3">List of your posts</div>
        </div>
    </div>
    <div class="row inline-blocks">
        @foreach($posts as $post)
            @include('profile.includes.post',['class'=>'col-md-6','edit'=>true,'showComments'=>true])
        @endforeach
    </div>
    {!!$posts->linksUri!!}
@endsection
