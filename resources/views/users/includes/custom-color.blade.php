@section('body-class','custom-color')
@push('styles')
    <style>
        :root {
            --chanelColor: #{{$user->channel->color??'2c95d8'}};
        }
    </style>
@endpush
