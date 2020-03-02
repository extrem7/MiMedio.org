@php
    /* @var $user App\Models\User
    * @var $posts \Illuminate\Support\Collection
    * @var $categories App\Models\Category[]
    */
@endphp

@extends('layouts.app')

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
            <section class="social-network mt-3 mt-md-5">
                <div class="title-semi-bold blue-color medium-size mb-4">Social Networks</div>
                <div class="custom-tab horizontal-overflow">
                    <a href="#facebook" class="" data-toggle="tab">Facebook</a>
                    <a href="#instagram" class="" data-toggle="tab">Instagram</a>
                    <a href="#twitter" class="" data-toggle="tab">Twitter</a>
                    <a href="#youtube" class="" data-toggle="tab">Youtube</a>
                </div>
                <div class="box-rounded tab-content">
                    <div class="tab-pane fade show active" id="facebook" role="tabpanel">1</div>
                    <div class="tab-pane fade" id="instagram" role="tabpanel">2</div>
                    <div class="tab-pane fade" id="twitter" role="tabpanel">3</div>
                    <div class="tab-pane fade" id="youtube" role="tabpanel">4</div>
                </div>
            </section>
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
                            @include('profile.includes.post')
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
