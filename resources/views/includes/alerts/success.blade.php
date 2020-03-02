@if(session($field??'status'))
    <div class="alert alert-primary">
        {{session($field??'status')}}
    </div>
@endif
