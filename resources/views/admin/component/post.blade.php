@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{ $slot }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection