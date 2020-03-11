@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le champ : {{ $field->name }}
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
            <a href="{{ route('fields.show', $formulaire->id) }}" class="m-nav__link">
                <span class="m-nav__link-text">Champs</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Créer un champ</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($field, array('url' => route('fields.update', $field->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', null, array('class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('formulaire_id', 'Identifiant du formulaire :') }}
                {{ Form::text('formulaire_id', null, array('class' => 'form-control text-center', 'readonly', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('backoffice', 'Affichage BO :') }} <span class="m--font-danger">*</span>
                {{ Form::select('backoffice', array('1' => 'Oui', '0'=> 'Non'), null, array('class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('label_bo', 'Label BO :') }} <span class="m--font-danger">*</span>
                {{ Form::text('label_bo', null, array('class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('label_fo', 'Label FO :') }} <span class="m--font-danger">*</span>
                {{ Form::text('label_fo', null, array('class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('type', 'Type du champ :') }} <span class="m--font-danger">*</span>
                {{ Form::select('type', \Modules\Formulaires\Http\Controllers\FieldsController::getListTypeForFields(), null, array('id'=> 'type', 'class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('required', 'Champ obligatoire :') }}
                {{ Form::select('required', array('1' => 'Oui', '0' => 'Non'), null, array('id'=>'required', 'class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('error_messages', 'Message d\'erreur :') }}
                {{ Form::text('error_messages', null, array('id'=>'error_messages', 'class' => 'form-control text-center')) }}
            </div>

            <div class="form-group">
                {{ Form::label('class', 'Class :') }}
                {{ Form::text('class', null, array('id'=>'class', 'class' => 'form-control text-center')) }}
            </div>

            <div id="optionnel">
                <div class="form-group">
                    {{ Form::label('placeholder', 'Placeholder :') }}
                    {{ Form::text('placeholder', null, array('id' => 'placeholder', 'class' => 'form-control text-center')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('value', 'Valeur par défaut :') }}
                    {{ Form::text('value', null, array('id' => 'value', 'class' => 'form-control text-center')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('min', 'Valeur minimum :') }}
                    {{ Form::text('min', null, array('id' => 'min', 'class' => 'form-control text-center')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('max', 'Valeur maximum :') }}
                    {{ Form::number('max', null, array('id' => 'max', 'class' => 'form-control text-center')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('step', 'Step :') }}
                    {{ Form::number('step', null, array('id' => 'step', 'class' => 'form-control text-center', 'min' => '0')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('col', 'Colonnes :') }}
                    {{ Form::number('col', null, array('id' => 'col', 'class' => 'form-control text-center', 'min' => '0')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('rows', 'Rows :') }}
                    {{ Form::number('rows', null, array('id' => 'rows', 'class' => 'form-control text-center', 'min' => '0')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('accept', 'Extensions acceptés :') }}
                    {{ Form::text('accept', null, array('id' => 'accept', 'class' => 'form-control text-center', 'placeholder'=>'.png,.gif,.pdf')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('multiple', 'Sélection multiple :') }}
                    {{ Form::select('multiple', array('1' => 'Oui', '0' => 'Non'), null, array('id' => 'multiple', 'class' => 'form-control text-center')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('tag', 'Tag :') }}
                    {{ Form::text('tag', null, array('id' => 'tag', 'class' => 'form-control text-center', 'placeholder'=>'h1')) }}
                </div>

            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('fields.show', $formulaire->id) }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('js')
    <script>

        // Ne pas oublier d'éditer le JS dans create.php par la suite
        function hideAll() {
            $("label[for='placeholder']").hide();
            $('#placeholder').hide();
            $("label[for='value']").hide();
            $('#value').hide();
            $("label[for='min']").hide();
            $('#min').hide();
            $("label[for='max']").hide();
            $('#max').hide();
            $("label[for='step']").hide();
            $('#step').hide();
            $("label[for='col']").hide();
            $('#col').hide();
            $("label[for='rows']").hide();
            $('#rows').hide();
            $("label[for='accept']").hide();
            $('#accept').hide();
            $("label[for='multiple']").hide();
            $('#multiple').hide();
            $("label[for='tag']").hide();
            $('#tag').hide();

            $("label[for='required']").hide();
            $('#required').hide();
            $("label[for='class']").hide();
            $('#class').hide();
            $("label[for='error_messages']").hide();
            $('#error_messages').hide();
        }

        function showTypeInputs(type)
        {
            if (type === "text") {
                console.log('ca marche');
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='min']").show();
                $('#min').show();
                $("label[for='max']").show();
                $('#max').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "email") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='min']").show();
                $('#min').show();
                $("label[for='max']").show();
                $('#max').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "password") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='min']").show();
                $('#min').show();
                $("label[for='max']").show();
                $('#max').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "hidden") {
                $("label[for='value']").show();
                $('#value').show();
            }
            if (type === "textarea") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='cols']").show();
                $('#cols').show();
                $("label[for='rows']").show();
                $('#rows').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "number") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='min']").show();
                $('#min').show();
                $("label[for='max']").show();
                $('#max').show();
                $("label[for='step']").show();
                $('#step').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "file") {
                $("label[for='accept']").show();
                $('#accept').show();
                $("label[for='multiple']").show();
                $('#multiple').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "image") {
                $("label[for='accept']").show();
                $('#accept').show();
                $("label[for='multiple']").show();
                $('#multiple').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "url") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "tel") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
            }
            if (type === "color") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "date") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "range") {
                $("label[for='placeholder']").show();
                $('#placeholder').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='min']").show();
                $('#min').show();
                $("label[for='max']").show();
                $('#max').show();
                $("label[for='step']").show();
                $('#step').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "select") {
                $("label[for='checked']").show();
                $('#checked').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();
                $("label[for='selected']").show();
                $('#selected').show();
                $("label[for='multiple']").show();
                $('#multiple').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "checkbox") {
                $("label[for='checked']").show();
                $('#checked').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "radio") {
                $("label[for='checked']").show();
                $('#checked').show();
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='disabled']").show();
                $('#disabled').show();

                $("label[for='required']").show();
                $('#required').show();
                $("label[for='class']").show();
                $('#class').show();
                $("label[for='error_messages']").show();
                $('#error_messages').show();
            }
            if (type === "static") {
                $("label[for='value']").show();
                $('#value').show();
                $("label[for='tag']").show();
                $('#tag').show();
            }
        }

        // Initialisation
        hideAll();
        showTypeInputs($('#type').val());

        // Fonction executé quand on change de type de champ
        $('#type').change(function () {
            //console.log($(this).val());
            hideAll();
            showTypeInputs($(this).val());
        })

    </script>
@endpush