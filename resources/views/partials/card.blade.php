@foreach($posts as $post)
    <div class="card shadow mb-5">
        <a class="text-dark" href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
            <img class="card-img-top" src="{{ $post->image }}" alt="Card image cap">
        </a>
        <div class="card-body">
            <p class="card-text">
                {{ optional($post->tags)->pluck('tag')->implode(' ') }}
            </p>
            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>

            <a class="text-dark" href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                <h5 class="card-title">{{ $post->title }}</h5>
            </a>

            <p class="card-text">{{ $post->excerpt }}</p>

            <a class="text-dark" href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                <small class="card-text">
                    Leer mas...
                </small>
            </a>
        </div>
    </div>
@endforeach