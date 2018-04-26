@if($post_most_seen->count())
    <div class="card card-shadow-light shadow-sm mb-5">
        <div class="card-body">
            <h4 class="card-title h4-font-italic" align="center">
                Tendencias
            </h4>
            <ul class="list-unstyled">
                @foreach($post_most_seen as $post)
                    <li class="media" style="padding: 1rem">
                        <img class="mr-3" src="{{ $post->image }}" width="64" height="64" alt="Generic placeholder image">
                        <div class="media-body">
                            <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}" class="mt-0 mb-1">{{ $post->title }}</a>
                        </div>
                    </li>
                    <hr>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(count($archives))
    <div class="card card-shadow-light shadow-sm mb-5">
        <div class="card-body">
            <h4 class="card-title h4-font-italic" align="center">
                Archivados
            </h4>
            <div class="list-inline">
                @foreach($archives as $stats)
                    <a class="list-inline-item badge badge-primary app-badge" href="{{ url("archives?month={$stats['month']}&year={$stats['year']}") }}">
                        {{ $stats['month'] . ' ' . $stats['year'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if($tags->count())
    <div class="card card-shadow-light shadow-sm mb-5">
        <div class="card-body">
            <h4 class="card-title h4-font-italic" align="center">
                Tags
            </h4>
            <div class="list-inline">
                @foreach($tags as $index => $slug)
                    <a class="list-inline-item badge badge-primary app-badge" href="{{ url("tags/{$slug}") }}">
                        {{ $index }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

<div class="card card-shadow-light shadow-sm mb-5">
    {!! config('ads.ads_side') !!}
</div>

@if(config('blog.youtube', false) || config('blog.facebook', false) || config('blog.instagram', false) || config('blog.twitter', false))
    <div class="card card-shadow-light shadow-sm mb-5">
        <div class="card-body">
            <h4 class="card-title h4-font-italic" align="center">
                Síguenos
            </h4>
            @if(config('blog.youtube', false))
                <a href="{{ config('blog.youtube', false) }}" class="fab fa-youtube social-btn shadow-sm"></a>
            @endif

            @if(config('blog.facebook', false))
                <a href="{{ config('blog.facebook') }}" class="fab fa-facebook-square social-btn shadow-sm"></a>
            @endif

            @if(config('blog.instagram', false))
                <a href="{{ config('blog.instagram') }}" class="fab fa-twitter social-btn shadow-sm"></a>
            @endif

            @if(config('blog.twitter', false))
                <a href="{{ config('blog.twitter') }}" class="fab fa-instagram social-btn shadow-sm"></a>
            @endif
        </div>
    </div>

@endif