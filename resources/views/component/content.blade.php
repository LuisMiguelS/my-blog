@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                {{ $slot }}
            </div>
            <div class="col-md-4">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection