@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le formulaire : {{ $formulaire->title }} ({{ $formulaire->uuid }})
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
            <a href="{{ route('formulaires.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Formulaires</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Editer un formulaire</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($formulaire, array('url' => route('formulaires.update', $formulaire->id), 'method' => 'PUT')) }}
            <h3>Formulaire</h3>
            <div class="form-group">
                {{ Form::label('uuid', 'UUID :') }} <span class="m--font-danger">*</span>
                {{ Form::text('uuid', null, array('class' => 'form-control', 'id' => 'uuid', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Titre :') }} <span class="m--font-danger">*</span>
                {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'required')) }}
            </div>

            <h3>Email FROM / TO</h3>
            <div class="form-group">
                {{ Form::label('name_from', 'Nom émetteur :') }}
                {{ Form::text('name_from', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email_from', 'Email émetteur :') }}
                {{ Form::email('email_from', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email_to', 'Email destinataire :') }}
                {{ Form::email('email_to', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email_to_cc', 'Emails destinataire supplémentaire (email1,email2) :') }}
                {{ Form::text('email_to_cc', null, array('class' => 'form-control')) }}
            </div>

            <!-- <h3>Champs</h3>
            <div id="formBuilder"></div>

            <div class="form-group">
                {{-- Form::label('content', 'Contenu :') --}}
                {{-- Form::textarea('content', null, array('class' => 'form-control', 'id'=>'content', 'readonly')) --}}
            </div> -->

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary', 'id'=>'editer')) }}
            <a class="btn btn-warning" href="{{ route('formulaires.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ asset('js/form-builder.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/form-render.min.js') }}" type="text/javascript"></script>

    <script>
        var formBuilder = $('#formBuilder').formBuilder()
        var dataForm = $('#content').val();


        $('#formBuilder').ready(function (){
            formBuilder.actions.setData(dataForm);
        });

        $('#formBuilder').on('click', '.save-template', function (){
            $('#content').val(formBuilder.actions.getData('json', true));
        });
    </script>
@endpush