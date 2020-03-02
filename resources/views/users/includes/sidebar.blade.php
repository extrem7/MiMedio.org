<div class="col-lg-4 col-12">
    @if($playlist)
        @include('posts.includes.playlist',['class'=>'mt-4 mt-lg-0'])
    @endif
    <div class="vote box-rounded">
        <div class="title-semi-bold blue-color medium-size">What thinks out users</div>
        <div class="title-dark semi-bold mt-2">What do you think about weather in this evening?</div>
        <div class="progress-bars">
            <div class="answer"><span class="blue-color">35% - </span> Mne pofigu</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width:35%" aria-valuenow="35"
                     aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="answer"><span class="blue-color">35% -</span> Mne pofigu</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width:35%" aria-valuenow="35"
                     aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="answer"><span class="blue-color">35% - </span> Mne pofigu</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width:35%" aria-valuenow="35"
                     aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="vote-answer">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label blue-color" for="customCheck1">Answer1 variation</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck2">
                <label class="custom-control-label blue-color" for="customCheck1">Answer1 variation</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck3">
                <label class="custom-control-label blue-color" for="customCheck1">Answer1 variation</label>
            </div>
        </div>
        <a href="" class="button btn-yellow btn-transform mt-3">Сreate new vote</a>
    </div>
</div>
