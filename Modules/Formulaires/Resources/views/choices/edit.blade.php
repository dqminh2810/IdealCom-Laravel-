@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le choix : {{ $choice->label }}
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
            <a href="{{ route('fields.show', $choice->field->formulaire) }}" class="m-nav__link">
                <span class="m-nav__link-text">Champs</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('fields.show', $choice->field) }}" class="m-nav__link">
                <span class="m-nav__link-text">Choix</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Editer un choix</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($choice, array('url' => route('choices.update', $choice->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('label', 'Label :') }} <span class="m--font-danger">*</span>
                {{ Form::text('label', null, array('class' => 'form-control text-center', 'required')) }}
            </div>


            <div class="form-group">
                {{ Form::label('value', 'Valeur :') }} <span class="m--font-danger">*</span>
                {{ Form::text('value', null, array('class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('selected', 'Sélectionné par défaut :') }} <span class="m--font-danger">*</span>
                {{ Form::select('selected', array('1' => 'Oui', '0'=> 'Non'), null, array('class' => 'form-control text-center', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('field_id', 'Identifiant du champ :') }} <span class="m--font-danger">*</span>
                {{ Form::text('field_id', null, array('class' => 'form-control text-center', 'readonly', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('choices.show', $choice->field) }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection