@extends('layouts.profile')

@section('sub-content')
    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="semi-bold blue-color medium-size mt-4 mb-3">@lang('mimedio.profile.playlist.title')</div>
            @include('includes.alerts.success',['field'=>'status'])
            <form action="{{route('settings.playlist.update')}}" method="post"
                  class="{{$errors->isEmpty()?:'was-validated'}}">
                @csrf
                <div class="form-group">
                    <label class="label mb-1" for="title">@lang('mimedio.profile.playlist.channel_title')</label>
                    <input type="text" id="title" name="title"
                           class="control-form mx-550 {{valid_class('title',$errors)}}"
                           value="{{old('title',$playlist->title??'')}}">
                    @include('includes.field-error',['error'=>'title'])
                </div>
                <div class="repeater">
                    @foreach(old('videos',$videos) as $row)
                        <div class="form-group d-flex align-items-center repeater-video repeater-row">
                            <input type="text" name="videos[{{$loop->index}}][title]"
                                   class="form-control @error('videos.'.$loop->index.'.title') is-invalid @enderror"
                                   value="{{ $row['title']}}"
                                   placeholder="@lang('mimedio.profile.playlist.video_title')" {{$loop->index!==0?'required':''}}>
                            <input type="text" name="videos[{{$loop->index}}][id]"
                                   class="form-control @error('videos.'.$loop->index.'.id') is-invalid @enderror"
                                   value="{{ $row['id']}}"
                                   placeholder="@lang('mimedio.profile.playlist.video_id')" {{$loop->index!==0?'required':''}}>
                            <input type="text" name="videos[{{$loop->index}}][duration]" class="form-control"
                                   value="{{$row['duration'] }}"
                                   placeholder="@lang('mimedio.profile.playlist.video_duration')">
                            <button class="icon delete-icon repeater-remove">
                                {!! get_svg('close') !!}
                            </button>
                        </div>
                    @endforeach
                </div>
                <a href="#" class="link ml-2 repeater-add">@lang('mimedio.profile.playlist.add')</a>
                <div class="d-flex justify-content-center text-center text-md-left">
                    <button
                        class="button btn-blue btn-transform mx-164 mt-4">@lang('mimedio.profile.settings.save')</button>
                </div>
            </form>
        </div>
        @if($playlist)
            <div class="col-lg-4">
                @include('posts.includes.playlist')
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        repeater()
    </script>
@endpush
