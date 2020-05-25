@php
    /* @var $channel App\Models\Channel */
@endphp
@if($channel->embed !== null && isset($channel->embed['facebook'],$channel->embed['instagram'],$channel->embed['twitter']))
    <section class="social-network mt-3 mt-md-5">
        <div class="title-semi-bold blue-color medium-size mb-4">Social Networks</div>
        <div class="nav custom-tab horizontal-overflow">
            @if(isset($channel->embed['facebook']))
                <a href="#facebook" class="" data-toggle="tab">Facebook</a>
            @endif
            <a href="#instagram" class="" data-toggle="tab">Instagram</a>
            @if(isset($channel->embed['twitter']))
                <a href="#twitter" class="" data-toggle="tab">Twitter</a>
            @endif
        </div>
        <div class="box-rounded tab-content vertical-scroll">
            @if(isset($channel->embed['facebook']))
                <div class="tab-pane fade show active" id="facebook" role="tabpanel">
                    <div class="text-center">
                        {!!$channel->embed['facebook']!!}
                    </div>
                </div>
            @endif
            @if(isset($channel->embed['instagram']))
                <div class="tab-pane fade" id="instagram" role="tabpanel">
                    {!!$channel->embed['instagram']!!}
                </div>
            @endif
            @if(isset($channel->embed['twitter']))
                <div class="tab-pane fade" id="twitter" role="tabpanel">
                    {!!$channel->embed['twitter']!!}
                </div>
            @endif
        </div>
    </section>
@endif
