@php
    /* @var $user App\Models\User */
@endphp
@if($user->embed !== null && (isset($user->embed['facebook']) || isset($user->embed['facebook'])))
    <section class="social-network mt-3 mt-md-5">
        <div class="title-semi-bold blue-color medium-size mb-4">Social Networks</div>
        <div class="nav custom-tab horizontal-overflow">
            @if(isset($user->embed['facebook']))
                <a href="#facebook" class="" data-toggle="tab">Facebook</a>
            @endif
        <!--<a href="#instagram" class="" data-toggle="tab">Instagram</a>-->
            @if(isset($user->embed['twitter']))
                <a href="#twitter" class="" data-toggle="tab">Twitter</a>
            @endif
        </div>
        <div class="box-rounded tab-content vertical-scroll">
            @if(isset($user->embed['facebook']))
                <div class="tab-pane fade show active" id="facebook" role="tabpanel">
                    <div class="text-center">
                        {!!$user->embed['facebook']!!}
                    </div>
                </div>
            @endif
        <!--<div class="tab-pane fade" id="instagram" role="tabpanel"></div>-->
            @if(isset($user->embed['twitter']))
                <div class="tab-pane fade" id="twitter" role="tabpanel">
                    {!!$user->embed['twitter']!!}
                </div>
            @endif
        </div>
    </section>
@endif
