@foreach($posts as $post)
    @if($post->category_id == $id_categoria and ($post->row_id_category >= 11 and $post->row_id_category <= 16))
        <!-- Post Article List -->
        <div class="card__post card__post-list card__post__transition mb-3">
            <div class="row ">
                <div class="col-md-5">
                    <div class="card__post__transition">
                        <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}">
                            <img src="{{ asset( isset($post->image) ? 'storage/' . $post->image : 'recursos/imagenes/post-default.png') }}" class="img-fluid w-100" alt="{{ $post->title }}">
                        </a>
                    </div>
                </div>
                <div class="col-md-7 my-auto pl-0">
                    <div class="card__post__body ">
                        <div class="card__post__content  ">
                            <div class="card__post__category ">
                                {{ $post->categoria }}
                            </div>
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
                                <h5>
                                    <a href="{{ url( $post->categoria_slug .'/'. $post->slug ) }}">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="d-none d-lg-block d-xl-block mb-0">
                                    {{ $post->excerpt }}...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach