@extends('layouts.app')

@section('content')
    @if(session($field??'error'))
        <div class="alert alert-danger">
            {{session($field??'error')}}
        </div>
    @endif
    <div class="row article-collapse-list inline-blocks">
        @foreach($items as $item)
            <div class="col-md-6 col-lg-4 collapse-card">
                @include('rss.includes.item')
            </div>
        @endforeach
    </div>
@endsection
