@extends('layouts.profile')

@section('sub-content')
    <div class="row">
        <div class="col-12">
            <div class="semi-bold blue-color medium-size mt-4 mb-3">@lang('mimedio.profile.post.list')</div>
        </div>
    </div>
    <settings-posts-list class="category-own-media"></settings-posts-list>
@endsection
