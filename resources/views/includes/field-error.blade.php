@error($error)
<span class="invalid-feedback {{isset($display)?'d-block':''}}" role="alert"><strong>{{ $message }}</strong></span>
@enderror
