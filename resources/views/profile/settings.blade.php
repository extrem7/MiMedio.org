@php
    /* @var $user App\Models\User
    * @var $avatar
    */
@endphp

@extends('layouts.profile')

@section('sub-content')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="semi-bold blue-color medium-size mt-4 mb-3">Profile settings</div>
            @include('includes.alerts.success')
            @if(!$user->has_password)
                <div class="alert alert-warning">
                    You have registered through a social network.<br>
                    Please set a password for your account in order to have full access to it.
                </div>
            @endif
            <form action="{{route('settings.update')}}" method="post" class="{{was_validated($errors)}}"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <div class="label mb-1">Picture</div>
                    <div class="text-center">
                        <img src="{{$avatar}}" class="img-fluid mb-2" style="max-height: 300px"
                             alt="avatar">
                    </div>
                    <div class="custom-file {{valid_class('avatar',$errors)}}">
                        <input type="file" class="custom-file-input" id="avatar" name="avatar">
                        <label class="custom-file-label" for="avatar">Upload your picture</label>
                    </div>
                    @include('includes.field-error',['error'=>'avatar'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">{{ __('Name') }}</div>
                    <input id="name" type="text"
                           class="form-control {{valid_class('name',$errors)}}" name="name"
                           value="{{ old('name',$user->name) }}" required autocomplete="name"
                           placeholder="{{ __('Name') }}" autofocus>
                    @include('includes.field-error',['error'=>'name'])
                </div>
                <div class="form-group">
                    <div
                        class="label mb-1">{{ __('E-Mail Address') }}{{!$user->has_password?' (Перед редактированием установите пароль)':''}}</div>
                    <input id="email" type="email"
                           class="form-control {{valid_class('email',$errors)}}" name="email"
                           value="{{ old('email',$user->email) }}" required placeholder="{{ __('E-Mail Address') }}"
                           autocomplete="email" {{!$user->has_password?'disabled':''}}>
                    @include('includes.field-error',['error'=>'email'])
                </div>
                <div class="form-group">
                    <div class="label mb-1">If you don't want to change password, leave this fields blank.</div>
                    <input id="password" type="password"
                           class="form-control {{valid_class('password',$errors)}}" name="password"
                           placeholder="{{ __('Password') }}" autocomplete="new-password">
                    @include('includes.field-error',['error'=>'password'])
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" placeholder="{{ __('Confirm Password') }}"
                           autocomplete="new-password">
                    <div class="d-flex justify-content-center text-center text-md-left">
                        <button class="button btn-blue btn-transform mx-164 mt-4">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
