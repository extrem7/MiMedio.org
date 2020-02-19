@extends('layouts.profile')
@push('styles')
    <style>
        .repeater > .repeater-row:first-child .repeater-remove {
            opacity: 0;
            pointer-events: none;
        }
    </style>
@endpush
@section('sub-content')
    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="semi-bold blue-color medium-size mt-4 mb-3">List of your videos</div>
            @include('includes.alerts.success',['field'=>'status'])
            <form action="{{route('playlist.update')}}" method="post" class="{{$errors->isEmpty()?:'was-validated'}}">
                @csrf
                <div class="form-group">
                    <label class="label mb-1" for="title">Channel title</label>
                    <input type="text" id="title" name="title"
                           class="control-form mx-550 {{valid_class('title',$errors)}}"
                           value="{{old('title',$playlist->title)}}">
                    @include('includes.field-error',['error'=>'title'])
                </div>
                <div class="repeater">
                    @foreach(old('videos',$videos) as $row)
                        <div class="form-group d-flex align-items-center repeater-video repeater-row">
                            <input type="text" name="videos[{{$loop->index}}][title]"
                                   class="form-control @error('videos.'.$loop->index.'.title') is-invalid @enderror"
                                   value="{{ $row['title']}}"
                                   placeholder="Title video" {{$loop->index!==0?'required':''}}>
                            <input type="text" name="videos[{{$loop->index}}][id]"
                                   class="form-control @error('videos.'.$loop->index.'.id') is-invalid @enderror"
                                   value="{{ $row['id']}}" placeholder="ID video" {{$loop->index!==0?'required':''}}>
                            <input type="text" name="videos[{{$loop->index}}][duration]" class="form-control"
                                   value="{{$row['duration'] }}" placeholder="Duration video">
                            <button class="icon delete-icon repeater-remove">
                                {!! get_svg('close') !!}
                            </button>
                        </div>
                    @endforeach
                </div>
                <a href="#" class="link ml-2 repeater-add">Add new video</a>
                <div class="d-flex justify-content-center text-center text-md-left">
                    <button class="button btn-blue btn-transform mx-164 mt-4">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            function updateInputName($input, index) {
                $($input).attr('name', $($input).attr('name').replace(/[0-9]/g, index))
            }

            $('body')
                .on('click', '.repeater-add', function (e) {
                    e.preventDefault()
                    const clone = $('.repeater .repeater-row:last-child').clone(),
                        index = $('.repeater .repeater-row').length
                    clone.find('input').each(function () {
                        $(this).val('')
                        updateInputName(this, index)
                    })
                    clone.appendTo('.repeater')
                })
                .on('click', '.repeater-remove', function () {
                    $(this).closest('.repeater-row').remove()
                    $('.repeater .repeater-row').each(function (index) {
                        $(this).find('input').each(function () {
                            updateInputName(this, index)
                        })
                    })
                })
        })
    </script>
@endpush
