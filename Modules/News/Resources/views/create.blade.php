@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Créer une nouvelle actualité
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('Image-Select-master/src/chosen/chosen.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Image-Select-master/src/ImageSelect.css')}}" />
@endpush

@section('nav')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="#" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('news.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Actualités</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Créer un article</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => route('news.store'),  'files' => true)) }}
        <!-- ENGLISH -->

            <div class="English box">
                <div class="form-group m-form__group row">
                    <h3 class="m-form__group--last">ENGLISH VERSION</h3>
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Titre :') }} <span class="m--font-danger">*</span>
                    {{ Form::text('en-title', null, array('class' => ['form-control', 'lang-en'])) }}
                </div>

                <div class="form-group">
                    {{ Form::label('resume', 'Résumé :') }} <span class="m--font-danger">*</span>
                    {{ Form::text('en-resume', null, array('class' => ['form-control','lang-en'])) }}
                </div>

                <div class="form-group">
                    {{ Form::label('content', 'Contenu :') }} <span class="m--font-danger">*</span>
                    {{ Form::textarea('en-content', null, array('class' => ['form-control','lang-en'],'id'=>'en-editor')) }}
                </div>
            </div>


            <!-- FRANCAIS -->

            <div class = "French box">
                <div class="form-group m-form__group row">
                    <h3 class="m-form__group--last">FRENCH VERSION</h3>
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Titre :') }} <span class="m--font-danger">*</span>
                    {{ Form::text('fr-title', null, array('class' => ['form-control', 'lang-fr'])) }}
                </div>

                <div class="form-group">
                    {{ Form::label('resume', 'Résumé :') }} <span class="m--font-danger">*</span>
                    {{ Form::text('fr-resume', null, array('class' => ['form-control','lang-fr'])) }}
                </div>

                <div class="form-group">
                    {{ Form::label('content', 'Contenu :') }} <span class="m--font-danger">*</span>
                    {{ Form::textarea('fr-content', null, array('class' => ['form-control','lang-fr'],'id'=>'fr-editor')) }}
                </div>
            </div>

            <div class="form-group m-form__group row">
                <h3 class="m-form__group--last">CUSTOM</h3>
            </div>

        <div class="form-group">
            {{ Form::label('image', 'Image :') }}
            {{ Form::select('image', \Modules\Medias\Facades\PhotosFacade::getArrayPhotoName() , null, array('class' => 'my-select'), \Modules\Medias\Facades\PhotosFacade::getAttributes()) }}

        </div>

            <div class="form-group">
                {{ Form::label('language', 'Langage :') }}
                {{ Form::select('language', \Modules\Languages\Facades\LanguagesFacade::getArrayLanguageCode() , null, array('class' => 'form-control')) }}
            </div>

        {{ Form::submit('Créer une nouvelle actualité', array('class' => 'btn btn-primary', 'id' => 'creer')) }}
        <a class="btn btn-warning" href="{{ route('news.index') }}">Annuler</a>
        {{ Form::close() }}
        </div>
    </div>
@stop


@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-beta.3/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#en-editor' ) )
            .catch( error => {
            console.error( error );
        } );
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#fr-editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script src="{{ asset('Image-Select-master/src/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('Image-Select-master/src/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
    <script src="{{ asset('Image-Select-master/src/ImageSelect.jquery.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".my-select").chosen({width:"100%"});
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#language').change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue){
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else{
                        $(".box").hide();
                    }
                });
            }).change();
        });
    </script>
@endpush