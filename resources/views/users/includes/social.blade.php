@php
    /* @var $channel App\Models\Channel */
@endphp
@if($channel->instagram || ($channel->embed !== null &&
(isset($channel->embed['facebook'])||isset($channel->embed['instagram'])||isset($channel->embed['twitter']))))
    <section class="social-network mt-3 mt-md-5">
        <div class="title-semi-bold blue-color medium-size mb-4">@lang('mimedio.channels.social')</div>
        <div class="nav custom-tab horizontal-overflow">
            @if(isset($channel->embed['facebook']))
                <a href="#facebook" class="" data-toggle="tab">Facebook</a>
            @endif
            @if(isset($channel->instagram))
                <a href="#instagram" class="" data-toggle="tab">Instagram</a>
            @endif
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
            @if(isset($channel->instagram))
                <div class="tab-pane fade" id="instagram" role="tabpanel">
                    <div class="gallery-widget">
                        @foreach($photos as $photo)
                            <a href="{{$photo['link']}}" target="_blank" class="gallery-widget-item">
                                <img src="{{$photo['src']}}" class="img-fit" alt="alt">
                            </a>
                        @endforeach
                    </div>
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
