@component('app_settings::input_group', compact('field'))
    <div class="repeater-header">
        <div class="row">
            <div class="col-md-5">
                <label for="">Title</label>
            </div>
            <div class="col-md-3">
                <label for="">Id</label>
            </div>
            <div class="col-md-3">
                <label for="">Duration</label>
            </div>
        </div>
    </div>
    <div class="repeater mb-2">
        @foreach(old($field['name'],\setting($field['name'])) as $row)
            <div class="row mb-1">
                <div class="col-md-5">
                    <input
                        type="text"
                        name="{{ $field['name'] }}[{{$loop->index}}][title]"
                        class="{{ Arr::get( $field, 'class', config('app_settings.input_class', 'form-control')) }}"
                        value="{{ $row['title']}}"
                    >
                </div>
                <div class="col-md-3">
                    <input
                        type="text"
                        name="{{ $field['name'] }}[{{$loop->index}}][id]"
                        class="{{ Arr::get( $field, 'class', config('app_settings.input_class', 'form-control')) }}"
                        value="{{ $row['id']}}"
                    >
                </div>
                <div class="col-md-3">
                    <input
                        type="text"
                        name="{{ $field['name'] }}[{{$loop->index}}][duration]"
                        class="{{ Arr::get( $field, 'class', config('app_settings.input_class', 'form-control')) }}"
                        value="{{$row['duration'] }}"
                    >
                </div>
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    <button type="button" class="close repeater-remove" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <button class="btn btn-primary repeater-add">Add video</button>
@endcomponent
