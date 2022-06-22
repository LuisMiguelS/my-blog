@foreach($posts as $post)
    @if($post->category_id == $id_categoria and $post->row_id_category <= 2)
        <div class="col-lg-6 pd-0">
            <div class="article__entry">
                <div class="article__image">
                    <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}">
                        <img src="{{ asset( isset($post->image) ? 'storage/' . $post->image : 'recursos/imagenes/post-default.png') }}" alt="{{ $post->title }}" class="img-fluid">
                    </a>
                </div>

                <div class="article__content">
                    <div class="article__category">
                        {{ $category->categoria }}
                    </div>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <span class="text-primary">
                                {{ $post->username }}
                            </span>
                        </li>
                        <li class="list-inline-item">
                            <span class="text-dark text-capitalize">
                                {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                            </span>
                        </li>
                    </ul>
                    <h5>
                        <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}">
                            {{ $post->title }}
                        </a>
                    </h5>
                    <p>{{ $post->excerpt }}...</p>
                    <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}" class="btn btn-outline-primary mb-4 text-capitalize"> Leer más...</a>
                </div>
            </div>
        </div>
    @endif
@endforeach

{{-- works original --}}
{{-- @foreach($posts as $post)
    <div class="col-lg-6 pd-0">
        <div class="article__entry">
            <div class="article__image">
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid">
                </a>
            </div>

            <div class="article__content">
                <div class="article__category">
                    {{ $category->name }}
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <span class="text-primary">
                            {{ $post->user->name }}
                        </span>
                    </li>
                    <li class="list-inline-item">
                        <span class="text-dark text-capitalize">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </li>
                </ul>
                <h5>
                    <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                        {{ $post->title }}
                    </a>
                </h5>
                <p>{{ $post->excerpt }}...</p>
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}" class="btn btn-outline-primary mb-4 text-capitalize"> Leer más...</a>
            </div>
        </div>
    </div>
@endforeach --}}

{{-- @foreach($posts as $post)
    <div class="card mb-5 shadow-sm">
        <a class="text-dark" href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
            <img class="card-img-top" src="{{ $post->image }}" alt="Card image cap">
        </a>
        <div class="card-body">
            <p class="card-text">
                {{ optional($post->tags)->pluck('tag')->implode(' ') }}
            </p>
            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>

            <a class="text-dark" href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
            </a>

            <p class="card-text">{{ $post->excerpt }}</p>

            <a class="text-dark" href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                <small class="card-text">
                    Leer mas...
                </small>
            </a>
        </div>
    </div>
@endforeach --}}