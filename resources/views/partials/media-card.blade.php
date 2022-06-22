@foreach($posts as $post)
    @if($post->category_id == $id_categoria and ($post->row_id_category >= 3 and $post->row_id_category <= 10))
        <div class="col-md-6">
            <div class="mb-3">
                <!-- Post Article -->
                <div class="card__post card__post-list">
                    <div class="image-sm">
                        <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}">
                            <img src="{{ asset( isset($post->image) ? 'storage/' . $post->image : 'recursos/imagenes/post-default.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>

                    <div class="card__post__body ">
                        <div class="card__post__content">
                            <div class="card__post__author-info mb-2">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-dark text-capitalize">
                                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <div class="card__post__title">
                                <h6>
                                    <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}">
                                        {{ $post->title }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

{{-- <ul class="list-unstyled">
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
</ul> --}}