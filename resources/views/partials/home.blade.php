<h6 class="font-weight-bold title_{{ $color }}">
    <span class="text-white">{{ $category->name }}</span>
</h6>
<div class="row">
    <div class="col-md-6">
        @include('partials.card', ['posts' => $category->posts->take(2)->all()])
    </div>

    <div class="col-md-6">
        @include('partials.media-card', ['posts' => $category->posts->take(-10)])
    </div>
</div>