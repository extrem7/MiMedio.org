@php
    /* @var $user App\Models\User
    * @var $posts \Illuminate\Support\Collection
    * @var $categories App\Models\Category[]
    */
@endphp

@extends('layouts.app')

@include('users.includes.custom-color')
@section('content')
    @include('users.includes.header')
    <div class="row">
        <div class="col-lg-8 col-12 my-own-media">
            <div class="box-rounded main-media">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $post = $posts->shift();
                        @endphp
                        @include('users.includes.post-large',compact('post'))
                    </div>
                    <posts-vertical-list
                        :initial_posts="{{json_encode($posts)}}"
                        :user_id="{{$user->id}}"></posts-vertical-list>
                </div>
            </div>
            @include('users.includes.social')
            @if($shared->isNotEmpty())
                <section class="category-own-media mt-3 mt-md-5">
                    <div class="d-flex slider-header justify-content-between align-items-center">
                        <div class="title-semi-bold blue-color medium-size">Shared news</div>
                        <div class="d-flex slide-panel">
                            <button class="button btn-silver-light slide-prev"><i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="button btn-silver-light slide-next ml-1"><i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="inline-block-pc">
                        @foreach($shared as $post)
                            @include('profile.includes.post')
                        @endforeach
                    </div>
                </section>
            @endif
            @foreach($categoriesWithPosts as $category)
                <section class="category-own-media mt-3 mt-md-5">
                    <div class="d-flex slider-header justify-content-between align-items-center">
                        <div class="title-semi-bold blue-color medium-size">{{$category->name}} news feed</div>
                        <div class="d-flex slide-panel">
                            <button class="button btn-silver-light slide-prev"><i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="button btn-silver-light slide-next ml-1"><i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="inline-block-pc">
                        @foreach($category->posts as $post)
                            @include('profile.includes.post',['hideAuthor'=>true])
                        @endforeach
                        <div class="d-flex align-items-center ml-2">
                            <a href="{{route('users.show.category',[
                           'user'=>$user->id,
                           'category'=>$category->slug
                           ])}}" class="button btn-yellow btn-transform">See all news</a>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
        @include('users.includes.sidebar')
    </div>
@endsection
@push('scripts')
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v6.0&appId=2267874190154020&autoLogAppEvents=1"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endpush
