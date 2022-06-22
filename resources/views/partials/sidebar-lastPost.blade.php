@foreach($posts as $post)
    <!-- List Article -->
    <div class="card__post__content p-3 card__post__body-border-all">
        <div class="card__post__category text-capitalize">
            {{ $post->category->name }}
        </div>
        <div class="card__post__author-info mb-2">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <span class="text-primary">
                        Publicado por {{ $post->user->name }}
                    </span>
                </li>
                <li class="list-inline-item">
                    <span class="text-dark text-capitalize">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </li>

            </ul>
        </div>
        <div class="card__post__title">
            <h5>
                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                    {{ $post->title }}
                </a>
            </h5>
        </div>
    </div>
@endforeach