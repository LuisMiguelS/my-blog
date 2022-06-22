@php $id_categoria = 0 @endphp

@foreach($categories as $category)
    @if($id_categoria != $category->category_id)
        <div class="wrapper__list__article">
            <h4 class="border_section">{{ $category->categoria }}</h4>

            @php $id_categoria = $category->category_id; @endphp

            <div class="row">
                @include('partials.card', ['posts' => $categories, 'id_categoria' => $id_categoria])
            </div>

            <div class="row pb-3">
                @include('partials.media-card', ['posts' => $categories, 'id_categoria' => $id_categoria])
            </div>

            <div class="wrapp__list__article-responsive">
                @include('partials.single-article-home', ['posts' => $categories, 'id_categoria' => $id_categoria])
            </div>
        </div>
    @endif

    @php $id_categoria = $category->category_id; @endphp
@endforeach

{{-- <div class="wrapper__list__article">
    <h4 class="border_section">{{ $category->name }}</h4>
    <div class="row ">
        @include('partials.card', ['posts' => $category->posts->take(2)])
    </div>

    <div class="row pb-3">
        @include('partials.media-card', ['posts' => $category->posts->take(10)])
    </div>

    <div class="wrapp__list__article-responsive">
        @include('partials.single-article-home', ['posts' => $category->posts])
    </div>
</div> --}}

{{-- <h6 class="font-weight-bold title_{{ $color }}">
    <span class="text-white">{{ $category->name }}</span>
</h6>
<div class="row">
    <div class="col-md-6">
        @include('partials.card', ['posts' => $category->posts->take(2)->all()])
    </div>

    <div class="col-md-6">
        @include('partials.media-card', ['posts' => $category->posts->take(-10)])
    </div>
</div> --}}