@php
    /* @var $user App\Models\User
    * @var $channel \App\Models\Channel
    * @var $logo
    */
@endphp

@extends('layouts.profile')

@section('sub-content')
    <div class="semi-bold blue-color medium-size mt-4 mb-3">@lang('mimedio.profile.channel.title')</div>
    @include('includes.alerts.success')
    <form action="{{route('settings.channel.update')}}" method="post" class="{{was_validated($errors)}}"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="form-group">
                    <div class="label mb-1">@lang('mimedio.profile.channel.slug')</div>
                    <input type="text" name="slug" value="{{old('slug',$user->slug)}}"
                           class="control-form {{valid_class('slug',$errors)}} mx-365">
                    @include('includes.field-error',['error'=>'slug'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">Facebook embed (<a
                            href="https://developers.facebook.com/docs/plugins/page-plugin" target="_blank">embed
                            page</a>,
                        <a href="https://developers.facebook.com/docs/plugins/embedded-posts" target="_blank">embed
                            post</a>, <a
                            href="https://developers.facebook.com/docs/plugins/embedded-video-player" target="_blank">embed
                            video</a>)
                    </div>
                    <textarea name="embed[facebook]" rows="7"
                              class="control-form {{valid_class('embed.facebook',$errors)}}">{{old('embed.facebook',$facebook)}}</textarea>
                    @include('includes.field-error',['error'=>'embed.facebook'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">Instagram
                        @if($instagram = $channel->instagram)
                            <span class="{{$instagram->is_actual?'text-success':'text-danger'}}">
                            ( {{$instagram->is_actual?'Actual':'Expired'}} )
                            </span>
                        @endif
                    </div>
                    <a href="{{route('auth.instagram.redirect')}}"
                       class="button btn-blue btn-transform mx-164">
                        {{$channel->instagram?'Reconnect':'Connect'}}
                        Instagram
                    </a>
                    @if($instagram = $channel->instagram)
                        <p class="mt-2">Expires at: {{$instagram->expires_at}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <div class="label mb-1">Twitter embed (<a href="https://publish.twitter.com/" target="_blank">create
                            embed code</a>)
                    </div>
                    <textarea name="embed[twitter]" rows="7"
                              class="control-form {{valid_class('embed.twitter',$errors)}}">{{old('embed.twitter',$twitter)}}</textarea>
                    @include('includes.field-error',['error'=>'embed.twitter'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">@lang('mimedio.profile.channel.rss_to_show')</div>
                    <select
                        class="control-form custom-select mt-2 mx-365 {{valid_class('rss_to_show',$errors)}}"
                        name="rss_to_show">
                        <option value="" selected>Choose</option>
                        @foreach($rssChannels as $rssChannel)
                            <option
                                value="{{$rssChannel->id}}"
                                {{selected(old('rss_to_show',$channel->rss_to_show)==$rssChannel->id)}}>
                                {{$rssChannel->name}}
                            </option>
                        @endforeach
                    </select>
                    @include('includes.field-error',['error'=>'rss_to_show'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">@lang('mimedio.profile.channel.following_to_show')</div>
                    <select
                        class="control-form custom-select mt-2 mx-365 {{valid_class('following_to_show_id',$errors)}}"
                        name="following_to_show_id">
                        <option value="" selected>Choose</option>
                        @foreach($user->followings as $following)
                            <option
                                value="{{$following->id}}"
                                {{selected(old('following_to_show_id',$channel->following_to_show_id)==$following->id)}}>
                                {{$following->name}}
                            </option>
                        @endforeach
                    </select>
                    @include('includes.field-error',['error'=>'following_to_show'])
                </div>
                <div class="label mb-1">@lang('mimedio.profile.channel.rss_feeds')</div>
                <rss-feeds></rss-feeds>
                @include('includes.field-error',['error'=>'rss_feeds'])
                <div class="text-center text-md-left">
                    <button
                        class="button btn-blue btn-transform mx-164 mt-4">@lang('mimedio.profile.settings.save')</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 design-channel">
                <div class="box-shadow-content d-flex align-items-center justify-content-center">
                    <div class="title-dark bold">@lang('mimedio.profile.channel.design')</div>
                </div>
                <div class="box-rounded up-to-top">
                    <div class="form-group mb-3 mt-3">
                        <div class="label mb-1 text-center">@lang('mimedio.profile.channel.logo')</div>
                        <div class="text-center">
                            <img src="{{$logo}}" class="img-fluid mb-2" style="max-height: 200px"
                                 alt="avatar">
                        </div>
                        <div class="custom-file {{valid_class('logo',$errors)}}">
                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label"
                                   for="logo">@lang('mimedio.profile.channel.upload_logo')</label>
                        </div>
                        @include('includes.field-error',['error'=>'logo'])
                    </div>
                    <div class="text-center title-dark bold">@lang('mimedio.profile.channel.color')</div>
                    <div class="mt-2 mb-3 text-center text-danger {{valid_class('color',$errors)}}">
                        <color-picker @if($user->color) initial="{{$user->color}}" @endif></color-picker>
                    </div>
                    @include('includes.field-error',['error'=>'color'])
                    <div class="text-center">
                        <button
                            class="button btn-blue btn-transform mx-164">@lang('mimedio.profile.settings.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(function () {
            repeater()
            bsCustomFileInput.init();
        });
    </script>
@endpush
