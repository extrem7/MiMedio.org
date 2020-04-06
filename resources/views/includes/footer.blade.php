<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="">QuIEnes Somos</a></li>
                    <li><a href="">Enlaces</a></li>
                    <li><a href="">Contacto</a></li>
                </ul>
                <div class="media-block mt-3">
                    <a href="{{config('mimedio.social.facebook.link')}}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{config('mimedio.social.instagram.link')}}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{config('mimedio.social.twitter.link')}}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{config('mimedio.social.youtube.link')}}" target="_blank">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="mt-3">Mimedio use libremente los contenidos citando la fuente.</div>
                <div class="mt-3">Sitio web creado <a href="https://raxkor.com/" class="copyright" target="_blank">Raxkor</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0">
                    @include('includes.social')
                </div>
            </div>
        </div>
    </div>
</footer>
