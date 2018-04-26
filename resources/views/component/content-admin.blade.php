@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('partials.sidebar-admin')
            </div>
            <div class="col-md-8">
                @include('partials.alert-message')

                {{ $slot }}
            </div>
        </div>
    </div>
@endsection