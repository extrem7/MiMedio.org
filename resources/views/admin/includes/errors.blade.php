@if(session('status'))
    <div class="callout callout-success">
        <h5 class="mb-0">{{session('status')}}</h5>
        @if(session('link'))
            <a class="card-link" href="{{session('link')}}">{{session('link')}}</a>
        @endif
    </div>
@endif
@if($errors->isNotEmpty())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
