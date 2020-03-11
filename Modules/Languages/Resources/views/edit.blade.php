@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le langage : {{ $language->name }}
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
            <a href="{{ route('languages.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Langages</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Editer un langage</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($language, array('url' => route('languages.update', $language->id), 'method'=>'PUT')) }}
            <div class="form-group">
                {{ Form::label('code', 'Code Numérique:') }} <span class="m--font-danger">*</span>
                {{ Form::text('code', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('native_name', 'Nom Natif :') }} <span class="m--font-danger">*</span>
                {{ Form::text('native_name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('countries.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection