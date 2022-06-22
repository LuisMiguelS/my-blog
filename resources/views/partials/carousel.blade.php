@foreach($carousel as $index => $post)
    <div class="item">
        <div class="card__post">
            <div class="card__post__body">
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                    <img src="{{ $post->image }}" class="img-fluid" alt="{{ optional($post->category)->name }}">
                </a>
                <div class="card__post__content bg__post-cover">
                    <div class="card__post__category">
                        {{ optional($post->category)->name }}
                    </div>
                    <div class="card__post__title">
                        <h2>
                            <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                    </div>
                    <div class="card__post__author-info">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">
                                    Publicado por {{ $post->user->name }}
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <span>
                                    {{ $post->created_at->format('l d, F Y') }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">

        @foreach($carousel as $index => $post)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                    <img class="d-block img-fluid" src="{{ $post->image }}" alt="Second slide">
                    <div class="carousel-caption">
                        <h3 class="img-tag">{{ optional($post->category)->name }}</h3>
                        <p class="img-title text-uppercase">{{ $post->title }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div> --}}