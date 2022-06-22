<!-- Publicidad -->
<div class="wrapper__list__article mb-3">
    @if(isset($page))
        @if($anuncio[1]->canShow)
            <div class="mb-4">
                {!! $anuncio[1]->link !!}
            </div>
        @endif
    @endif

    @if($anuncio[4]->canShow)
        <a href="{{ $anuncio[4]->url }}">
            <figure>
                <img src="{{ $anuncio[4]->banner }}" alt="" class="img-fluid image-ads">
            </figure>
        </a>
    @endif

    @if($anuncio[5]->canShow)
        {!! $anuncio[5]->url !!}
    @endif
</div>
<!-- End Publicidad -->

<!-- social media -->
@if(setting()->get('blog.blog_facebook') or
    setting()->get('blog.blog_twitter') or
    setting()->get('blog.blog_instagram') or
    setting()->get('blog.blog_youtube'))
    <aside class="wrapper__list__article">
        <h4 class="border_section">Síguenos en las redes sociales</h4>
        <!-- widget Social media -->
        <div class="wrap__social__media">
            @if(setting()->get('blog.blog_instagram'))
                <a href="{{ setting()->get('blog.blog_instagram') }}" target="_blank">
                    <div class="social__media__widget instagram-sidebar">
                        <span class="social__media__widget-icon">
                            <i class="fa fa-instagram"></i>
                        </span>
                        <span class="social__media__widget-counter">
                            Instagram
                        </span>
                        <span class="social__media__widget-name">
                            Síguenos
                        </span>
                    </div>
                </a>
            @endif

            @if(setting()->get('blog.blog_facebook'))
                <a href="{{ setting()->get('blog.blog_facebook') }}" target="_blank">
                    <div class="social__media__widget facebook">
                        <span class="social__media__widget-icon">
                            <i class="fa fa-facebook"></i>
                        </span>
                        <span class="social__media__widget-counter">
                           Facebook
                        </span>
                        <span class="social__media__widget-name">
                            Like
                        </span>
                    </div>
                </a>
            @endif

            @if(setting()->get('blog.blog_twitter'))
                <a href="{{ setting()->get('blog.blog_twitter') }}" target="_blank">
                    <div class="social__media__widget twitter">
                        <span class="social__media__widget-icon">
                            <i class="fa fa-twitter"></i>
                        </span>
                        <span class="social__media__widget-counter">
                           Twitter
                        </span>
                        <span class="social__media__widget-name">
                            Síguenos
                        </span>
                    </div>
                </a>
            @endif

            @if(setting()->get('blog.blog_youtube'))
                <a href="{{ setting()->get('blog.blog_youtube') }}" target="_blank">
                    <div class="social__media__widget youtube">
                        <span class="social__media__widget-icon">
                            <i class="fa fa-youtube"></i>
                        </span>
                        <span class="social__media__widget-counter">
                           YouTube
                        </span>
                        <span class="social__media__widget-name">
                            Suscríbete
                        </span>
                    </div>
                </a>
            @endif
        </div>
    </aside>
@endif
<!-- End social media -->

<!-- Tags -->
@if($tags->count())
    <aside class="wrapper__list__article">
        <h4 class="border_section">Tags</h4>
        <div class="blog-tags p-0">
            <ul class="list-inline">
                @foreach($tags as $index => $slug)
                    <li class="list-inline-item">
                        <a href="{{ url("tags/{$slug}") }}">
                            #{{ $index }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
@endif
<!-- End Tags -->

<!-- Publicidad -->
@if($anuncio[6]->canShow)
    <aside class="wrapper__list__article">
        <a href="{{ $anuncio[6]->url }}">
            <figure>
                <img src="{{ $anuncio[6]->banner }}" alt="" class="img-fluid image-ads">
            </figure>
        </a>
    </aside>
@endif
<!-- End Publicidad -->

{{-- Últimas noticias --}}
<aside class="wrapper__list__article">
    <h4 class="border_section">Últimas Noticias</h4>
    
    @include('partials.sidebar-lastPost', ['posts' => $lastPost ])
</aside>
{{-- end Últimas noticias --}}

<!-- Archivados -->
@if(count($archives))
    <aside class="wrapper__list__article">
        <h4 class="border_section">Archivados</h4>
        <div class="blog-tags p-0">
            <ul class="list-inline">
                @foreach($archives as $stats)
                    <li class="list-inline-item">
                        <a href="{{ url("archives?month={$stats['month']}&year={$stats['year']}") }}">
                            {{ $stats['mes'] . ' ' . $stats['year'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
@endif
<!-- End Archivados -->

<!-- Publicidad -->
<aside class="wrapper__list__article">
    {{-- <h4 class="border_section">Publicidad</h4> --}}

    @if($anuncio[7]->canShow)
        <a href="{{ $anuncio[7]->url }}">
            <figure>
                <img src="{{ $anuncio[7]->banner }}" alt="" class="img-fluid image-ads">
            </figure>
        </a>
    @endif

    @if($anuncio[8]->canShow)
        <a href="{{ $anuncio[8]->url }}">
            <figure>
                <img src="{{ $anuncio[8]->banner }}" alt="" class="img-fluid image-ads">
            </figure>
        </a>
    @endif
</aside>
<!-- End Publicidad -->

@if(count($post_most_seen))
    {{-- Noticias más visitadas --}}
    <aside class="wrapper__list__article">
        <h4 class="border_section">Tendencia</h4>

        @foreach($post_most_seen as $post)
            <div class="mb-3">
                <!-- Post Article -->
                <div class="card__post card__post-list">
                    <div class="image-sm">
                        <a href="{{ $post->category }}/{{ $post->slug }}">
                            <img src="{{ asset( isset($post->image) ? 'storage/' . $post->image : 'recursos/imagenes/post-default.png') }}" class="img-fluid" alt="{{ $post->title }}">
                        </a>
                    </div>

                    <div class="card__post__body ">
                        <div class="card__post__content">
                            <div class="card__post__author-info mb-2">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            Publicado por {{ $post->username }}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="text-dark text-capitalize">
                                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                        </span>
                                    </li>

                                </ul>
                            </div>

                            <div class="card__post__title">
                                <h6>
                                    <a href="{{ $post->category }}/{{ $post->slug }}">
                                        {{ $post->title }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </aside>
@endif

<!-- Publicidad -->
<aside class="wrapper__list__article">
    {{-- <h4 class="border_section">Publicidad</h4> --}}
    
    @if($anuncio[9]->canShow)
        <a href="{{ $anuncio[9]->url }}">
            <figure>
                <img src="{{ $anuncio[9]->banner }}" alt="" class="img-fluid image-ads">
            </figure>
        </a>
    @endif

    @if($anuncio[10]->canShow)
        {!! $anuncio[10]->url !!}
    @endif
</aside>
<!-- End Publicidad -->