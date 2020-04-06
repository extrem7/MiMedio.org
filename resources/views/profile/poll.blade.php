@extends('layouts.profile')

@section('sub-content')
    <div class="row">
        <div class="col-xl-7 col-lg-8">
            <div class="title-semi-bold blue-color medium-size mb-3">Your poll</div>
            @include('includes.alerts.success',['field'=>'status'])
            <form method="post" action="{{route('poll.create')}}"
                  class="box-rounded form-wrapper {{$errors->isEmpty()?:'was-validated'}}">
                @csrf
                <div class="form-group">
                    <textarea name="question" id="question" rows="3"
                              class="form-control {{valid_class('question',$errors)}}"
                              placeholder="Question text">{{old('question',$poll->question??'')}}</textarea>
                    @include('includes.field-error',['error'=>'question'])
                </div>
                <div class="repeater poll-repeater">
                    @foreach(old('answers',$answers??['','']) as $answer)
                        <div class="form-group d-flex align-items-center repeater-row">
                            <input type="text" name="answers[{{$loop->index}}]"
                                   class="form-control mx-365 @error('answers.'.$loop->index) is-invalid @enderror"
                                   placeholder="Add answer option" value="{{$answer}}">
                            @if(empty($answers) && $loop->index!==0)
                                <button class="icon ml-3 delete-icon repeater-remove">
                                    {!! get_svg('close') !!}
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                @include('includes.field-error',['error'=>'answers','display'=>true])
                <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row mt-4">
                    <a href="#" class="link mr-3 repeater-add">Add answer option</a>
                    <div class="d-flex justify-content-center btn-action-form">
                        <!--<a href="" class="button btn-silver-light mx-164 cancel-btn btn-transform">Cancel</a>-->
                        @empty($answers)
                            <button class="button btn-blue mx-164 ml-2 btn-transform">Create</button>
                        @else
                            <button class="button btn-yellow mx-164 ml-2 btn-transform">Save</button>
                        @endempty
                    </div>
                </div>
            </form>
            @if(!empty($answers))
                <form method="post" action="{{route('poll.delete')}}">
                    @csrf
                    @method('DELETE')
                    <button class="button btn-yellow mx-164 mt-3 btn-transform">Reset poll</button>
                </form>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        repeater()
    </script>
@endpush
