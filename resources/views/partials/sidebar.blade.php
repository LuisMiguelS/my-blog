@if($lastPost->count())
    <h6 class="font-weight-bold default">
        <span class="text-white">Ultimas noticias</span>
    </h6>
    <div class="card bg-transparent mb-5">
        <div class="card-body">
            @include('partials.media-card', ['posts' => $post_most_seen])
        </div>
    </div>
@endif

@if($post_most_seen->count())
    <h6 class="font-weight-bold default">
        <span class="text-white">Tendencia</span>
    </h6>
    <div class="card  bg-transparent mb-5">
        <div class="card-body">
            @include('partials.media-card', ['posts' => $post_most_seen])
        </div>
    </div>
@endif

@if(count($archives))
    <h6 class="font-weight-bold default">
        <span class="text-white">Archivados</span>
    </h6>
    <div class="card shadow-sm mb-5">
        <div class="card-body">
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
    <h6 class="font-weight-bold default">
        <span class="text-white">Tags</span>
    </h6>
    <div class="card shadow-sm mb-5">
        <div class="card-body">
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

<div class="card bg-transparent mb-5">
    {!! setting()->get('ads.ads_side') !!}
</div>

{!! setting()->get('shareThis.share_block') !!}