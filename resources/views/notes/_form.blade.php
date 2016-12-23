<div class="ui form">
    <div class="field">
        <label for="title">Title</label>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
    </div>
    <div class="field">
        <label for="wysiwygEditor">Content</label>
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'content', 'id' => 'wysiwygEditor']) !!}
    </div>
</div>

@section('script')
    <script src="/assets/editors/ckeditor/ckeditor.js"></script>
    <script>
        var token = '{{ csrf_token() }}';
        $('#lessons').dropdown();
        CKEDITOR.replace('wysiwygEditor', {
            filebrowserImageBrowseUrl: '/files?type=Images',
            filebrowserImageUploadUrl: '/files/upload?type=Images&_token='+token,
            filebrowserBrowseUrl: '/files?type=Files',
            filebrowserUploadUrl: '/files/upload?type=Files&_token='+token
        });
        CKEDITOR.config.height = 600;
        CKEDITOR.config.skin = 'office2013';
        CKEDITOR.config.height = 600;
        CKEDITOR.config.extraPlugins = 'toc,list,wsc,templates,uploadimage,uploadwidget,filetools,codesnippet,youtube,pbckcode,base64image,pastefromexcel,chart,autocorrect,scayt';
        CKEDITOR.config.removeButtons = 'About';
        CKEDITOR.config.tocTag = 'h1';
        CKEDITOR.config.tocTitle = "Table of Content";

        CKEDITOR.on('dialogDefinition', function (ev) {
            var dialogName = ev.data.name;
            var dialogDefinition = ev.data.definition;

            if (dialogName === 'table') {
                var addCssClass = dialogDefinition.getContents('advanced').get('advCSSClasses');
                addCssClass['default'] = 'ui celled striped table';
            }
        });
    </script>
@endsection

@section('style')
    <style>
        #cke_wysiwygEditor {
            border-radius: 3px;
            overflow: hidden;
            border: 1px solid #cccccc !important;
        }

        #cke_1_bottom {
            background: #cccccc !important;
            border-top: 1px solid #ccc;
        }
    </style>
@endsection