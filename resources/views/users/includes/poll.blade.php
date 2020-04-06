@php
    /* @var $poll Poll
    * @var $answers array
    */
    use App\Models\Polls\Poll;
@endphp
@if($poll)
    <div class="vote box-rounded">
        <div class="title-semi-bold blue-color medium-size">What our users think</div>
        <div class="title-dark semi-bold mt-2">{{$poll->question}}</div>
        <div class="progress-bars">
            @foreach($answers as $option)
                <div class="answer"><span
                        class="blue-color">{{ $option->percent??0 }}% - </span> {{ $option->name }}{{$option->voted?' (You voted for it)':''}}
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width:{{ $option->percent }}%"
                         aria-valuenow="{{ $option->percent }}"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            @endforeach
        </div>
        @if(Auth::check())
            @if(!Auth::user()->hasVoted($poll->id))
                <form method="POST" action="{{ route('poll.vote', $poll->id) }}" class="vote-answer">
                    @csrf
                    @foreach($poll->options as $option)
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="option-{{$option->id}}"
                                   name="options"
                                   value="{{$option->id}}">
                            <label class="custom-control-label blue-color"
                                   for="option-{{$option->id}}">{{$option->name}}</label>
                        </div>
                    @endforeach
                    <button class="button btn-yellow btn-transform mt-3">Vote!</button>
                </form>
            @endif
        @else
            <p class="mt-3">Please <a href="{{route('login')}}">login</a> or <a href="{{route('register')}}">register</a> to vote</p>
        @endif
    </div>
@endif
