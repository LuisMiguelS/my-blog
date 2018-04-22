@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Construir Post</li>
                    </ol>
                </nav>

                @if(Session::has('success'))
                    <div class="container">
                        <div class="alert alert-success" role="alert">
                            <em> {!! session('success') !!}</em>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            tinymce.init({
                menubar: false,
                selector:'#body',
                height: 600,
                skin: 'blog',
                language: 'es_MX',
                resize: 'vertical',
                plugins: 'link, image, code, youtube, giphy, table, textcolor, lists',
                extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
                toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube giphy | code',
                convert_urls: false,
                media_live_embeds: true,
                image_caption: true,
                image_title: true,
                paste_data_images: true,
                paste_as_text: true,
                statusbar: false,
                init_instance_callback: function (editor) {
                    if (typeof tinymce_init_callback !== "undefined") {
                        tinymce_init_callback(editor);
                    }
                },
                mobile: {
                    theme: 'mobile',
                    plugins: [ 'autosave', 'lists', 'autolink', 'youtube', 'giphy' ]
                }
            });

            $('#status').select2({language: "es"});
            $('#category_id').select2({language: "es"});
            $('#tags').select2({language: "es"});
        });
    </script>
@endsection