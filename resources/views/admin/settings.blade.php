@extends('admin.layouts.base')
@section('title','Settings')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @includeIf(config('app_settings.flash_partial'))

                <form method="post" action="{{ config('app_settings.url') }}" class="form-horizontal mb-3"
                      enctype="multipart/form-data" role="form">
                    {!! csrf_field() !!}

                    @if( isset($settingsUI) && count($settingsUI) )
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)
                                    @php $name = Str::slug($fields['title'])  @endphp
                                    <li class="nav-item">
                                        <a class="nav-link bg-light {{$loop->index==0?'active':''}}"
                                           id="{{$name}}-link" data-toggle="pill"
                                           href="#section-{{ $name }}" role="tab"
                                           aria-controls="section-{{ $name }}"
                                           aria-selected="true">
                                            <i class="{{ Arr::get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                            {{ $fields['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card card-tabs">
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)
                                        @php $name = Str::slug($fields['title'])  @endphp
                                        <div class="tab-pane fade {{$loop->index==0?'show active':''}}"
                                             id="section-{{ $name }}" role="tabpanel"
                                             aria-labelledby="{{ $name }}">
                                            <div
                                                class="{{ Arr::get($fields, 'section_body_class', config('app_settings.section_body_class', 'card-body')) }}">
                                                @foreach(Arr::get($fields, 'inputs', []) as $field)
                                                    @if(!view()->exists('app_settings::fields.' . $field['type']))
                                                        <div
                                                            style="background-color: #f7ecb5; box-shadow: inset 2px 2px 7px #e0c492; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1rem">
                                                            Defined setting <strong>{{ $field['name'] }}</strong> with
                                                            type <code>{{ $field['type'] }}</code> field is not
                                                            supported. <br>
                                                            You can create a <code>fields/{{ $field['type'] }}
                                                                .balde.php</code> to
                                                            render this input however you want.
                                                        </div>
                                                    @endif
                                                    @includeIf('app_settings::fields.' . $field['type'] )
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <button class="btn-primary btn">
                                {{ Arr::get($settingsUI, 'submit_btn_text', 'Save Settings') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            function updateInputName($input, index) {
                $($input).attr('name', $($input).attr('name').replace(/[0-9]/g, index));
            }

            $('body')
                .on('click', '.repeater-add', function (e) {
                    e.preventDefault();
                    const clone = $('.repeater .row:last-child').clone(),
                        index = $('.repeater .row').length;
                    clone.find('input').each(function () {
                        $(this).val('');
                        updateInputName(this, index);
                    });
                    clone.appendTo('.repeater');
                })
                .on('click', '.repeater-remove', function () {
                    $(this).closest('.row').remove();
                    $('.repeater .row').each(function (index) {
                        $(this).find('input').each(function () {
                            updateInputName(this, index);
                        });
                    });
                });
        });
    </script>
@endpush
