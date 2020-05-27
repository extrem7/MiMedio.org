@extends('layouts.profile')

@section('sub-content')
    <div class="row">
        <div class="col-12">
            <div class="title-semi-bold blue-color medium-size mb-3">@lang('mimedio.profile.post.create')</div>
            <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data"
                  class="box-rounded form-wrapper">
                @csrf
                <div class="form-group">
                    <label class="label mb-1" for="title">@lang('mimedio.profile.post.create')</label>
                    <input type="text" id="title" name="title"
                           class="control-form mx-550 {{valid_class('title',$errors)}}" value="{{old('title')}}">
                    @include('includes.field-error',['error'=>'title'])
                </div>
                <div class="form-group">
                    <select name="category_id"
                            class="control-form custom-select mx-550 {{valid_class('category_id',$errors)}}">
                        <option selected disabled>@lang('mimedio.profile.post.category')</option>
                        @foreach($categories as $id=>$name)
                            <option value="{{$id}}" {{selected(old('category_id')==$id)}}>{{$name}}</option>
                        @endforeach
                    </select>
                    @include('includes.field-error',['error'=>'category_id'])
                </div>
                <div class="form-group">
                    <label class="label mb-1" for="body">@lang('mimedio.profile.post.body')</label>
                    <textarea id="body" name="body"
                              class="control-form {{valid_class('body',$errors)}}">{{old('body')}}</textarea>
                    @include('includes.field-error',['error'=>'body'])
                </div>
                <div class="form-group">
                    <label class="label mb-1" for="excerpt">@lang('mimedio.profile.post.excerpt')</label>
                    <textarea id="excerpt" name="excerpt"
                              class="control-form {{valid_class('excerpt',$errors)}}">{{old('excerpt')}}</textarea>
                    @include('includes.field-error',['error'=>'excerpt'])
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4 btn-action-form">
                    <div class="form-group images-form-group mb-0">
                        <div class="label mb-1">@lang('mimedio.profile.post.thumbnail')</div>
                        <div class="images-preview" id="image_preview"></div>
                        <div class="custom-file {{valid_class('image',$errors)}}">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">@lang('mimedio.profile.post.upload_picture')</label>
                        </div>
                        @include('includes.field-error',['error'=>'image'])
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="label mb-1" for="status">@lang('mimedio.profile.post.status'):</label>
                            <select id="status" name="status"
                                    class="control-form custom-select mx-550 {{valid_class('status',$errors)}}">
                                @foreach($statuses as $id=>$name)
                                    <option value="{{$id}}" {{selected(old('status')==$id)}}>{{$name}}</option>
                                @endforeach
                            </select>
                            @include('includes.field-error',['error'=>'status'])
                        </div>
                        <button class="button btn-blue mx-164 btn-transform">@lang('mimedio.profile.post.post')</button>
                        <a href="#" class="button btn-silver-light mx-164 ml-2 btn-transform preview">@lang('mimedio.profile.post.preview')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script>
        initEditors()
        imagePreview()
    </script>
@endpush
