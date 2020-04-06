@php
    /* @var $user App\Models\User
    * @var $logo
    */
@endphp

@extends('layouts.profile')

@section('sub-content')
    <div class="semi-bold blue-color medium-size mt-4 mb-3">Channel settings</div>
    @include('includes.alerts.success')
    <form action="{{route('settings.channel.update')}}" method="post" class="{{was_validated($errors)}}"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="form-group">
                    <div class="label mb-1">Url slug of channel (mimedio.org/channel/{slug})</div>
                    <input type="text" name="slug" value="{{old('slug',$user->slug)}}" class="control-form {{valid_class('slug',$errors)}} mx-365">
                    @include('includes.field-error',['error'=>'slug'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">Facebook embed</div>
                    <textarea name="embed[facebook]" rows="7"
                              class="control-form {{valid_class('embed.facebook',$errors)}}">{{old('embed.facebook',$facebook)}}</textarea>
                    @include('includes.field-error',['error'=>'embed.facebook'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">Twitter embed</div>
                    <textarea name="embed[twitter]" rows="7"
                              class="control-form {{valid_class('embed.twitter',$errors)}}">{{old('embed.twitter',$twitter)}}</textarea>
                    @include('includes.field-error',['error'=>'embed.twitter'])
                </div>
                <div class="text-center text-md-left">
                    <button class="button btn-blue btn-transform mx-164 mt-4">Save</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 design-channel">
                <div class="box-shadow-content d-flex align-items-center justify-content-center">
                    <div class="title-dark bold">Design of my channel</div>
                </div>
                <div class="box-rounded up-to-top">
                    <div class="form-group mb-3 mt-3">
                        <div class="label mb-1 text-center">Channel logo</div>
                        <div class="text-center">
                            <img src="{{$logo}}" class="img-fluid mb-2" style="max-height: 200px"
                                 alt="avatar">
                        </div>
                        <div class="custom-file {{valid_class('logo',$errors)}}">
                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Upload logo</label>
                        </div>
                        @include('includes.field-error',['error'=>'logo'])
                    </div>
                    <div class="text-center title-dark bold">Choose the color of your channel</div>
                    <div class="mt-2 mb-3 text-center text-danger {{valid_class('color',$errors)}}">
                        <color-picker @if($user->color) initial="{{$user->color}}" @endif></color-picker>
                    </div>
                    @include('includes.field-error',['error'=>'color'])
                    <div class="text-center">
                        <button class="button btn-blue btn-transform mx-164">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
