@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                {{ $slot }}
            </div>
            <div class="col-md-2">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection