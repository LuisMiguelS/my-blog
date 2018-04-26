<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">

        @foreach($carousel as $index => $post)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                    <img class="d-block img-fluid" src="{{ $post->image }}" alt="Second slide">
                    <div class="carousel-caption">
                        <h3>{{ optional($post->category)->name }}</h3>
                        <p class="font-weight-bold text-uppercase">{{ $post->title }}</p>
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
</div>