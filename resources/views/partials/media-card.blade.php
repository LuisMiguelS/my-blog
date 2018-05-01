<ul class="list-unstyled">
    @foreach($posts as $post)
        <li class="media {{ $media_style ?? 'bg-white shadow-sm' }} mb-1" style="padding: 1rem">
            <img class="mr-3" src="{{ $post->image }}" width="64" height="64">
            <div class="media-body">
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}" class="mt-0 mb-1 font-weight-bold {{ $color_white ?? 'text-dark' }}">{{ $post->title }}</a>
                <br>
                <small>{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </li>

    @endforeach
</ul>