@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.12.17/css/grapes.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/grapesjs-preset-webpage.min.css') }}">
@endpush

@section('title')
    Editer la page de contenu: {{ $page->title }}
@endsection

@section('nav')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="#" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('pages.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Pages de contenu</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('pages.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Editer une page de contenu</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">

        <div id="gjs">
            {!! $page->code !!}
        </div>

    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($page, array('route' => array('pages.update', $page->id), 'method' => 'PUT')) }}
            <div class="form-group">
                {{ Form::label('title', 'Titre :') }} <span class="m--font-danger">*</span>
                {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('url', 'URL :') }} <span class="m--font-danger">*</span>
                {{ Form::url('url', null, array('class' => 'form-control', 'id' => 'url', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('code', 'Code :') }}
                {{ Form::text('code', null, array('class' => 'form-control', 'id' => 'code', 'readonly')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            <a class="btn btn-brand" href="javascript:;" id="generate">Générer le code</a>
            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('pages.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.12.17/grapes.min.js"></script>
    <script src="{{ asset('js/grapesjs-preset-webpage.min.js') }}"></script>
    <script src="{{ asset('js/grapesjs-lory-slider.min.js') }}"></script>
    <script type="text/javascript">
        var grapesjs_editor = grapesjs.init({
            container : '#gjs',
            plugins: ['gjs-preset-webpage','grapesjs-lory-slider'],
            pluginsOpts: {
                'gjs-preset-webpage': {
                },
                'grapesjs-lory-slider': {
                    sliderBlock: {
                        category: 'Extra'
                    }
                }
            },
            fromElement: true,
            storageManager: {
                autoload: false
            }
        });
    </script>
    <script src="{{ asset('js/grapesjs-block-gabarit.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $( "#generate" ).click(function() {
            var code = "<style>" + grapesjs_editor.getCss() + "</style> " + grapesjs_editor.getHtml();
            $('#code').val(code);
        });
    </script>
    <script>
        function slugify(text)
        {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        $( "#url" ).mouseenter(function() {
            var url = '{{ url('/') }}' + '/' + slugify($('#title').val());
            $( this ).val(url);
        });
    </script>
@endpush