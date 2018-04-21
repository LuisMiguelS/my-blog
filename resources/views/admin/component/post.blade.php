@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                selector:'#body',
                height: 400,
                theme: 'modern',
                language: 'es_MX',
                plugins: [
                    'print preview searchreplace autolink directionality visualblocks visualchars',
                    'fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc',
                    'insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
                ],
                toolbar1:
                'formatselect | bold italic strikethrough forecolor backcolor | link |' +
                'alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                media_live_embeds: true,
                default_link_target: "_blank",
                paste_data_images: true,
                paste_as_text: true,
                statusbar: false,
                mobile: {
                    theme: 'mobile',
                    plugins: [ 'autosave', 'lists', 'autolink' ]
                }
            });

            $('#category_id').select2({language: "es"});
            $('#tags').select2({language: "es"});
        });
    </script>
@endsection