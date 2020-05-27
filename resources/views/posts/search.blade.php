@extends('layouts.app')

@section('content')
    <h1 class="post-name mb-4">@lang('mimedio.search.title'): "{{$query}}"</h1>
    <posts-list></posts-list>
@endsection
