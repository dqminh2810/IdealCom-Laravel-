@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Création d'un menu
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
            <a href="{{ route('menus.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Menus</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Créer un menu</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('menus.store'))) }}
            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('display_name', 'Désignation :') }} <span class="m--font-danger">*</span>
                {{ Form::text('display_name', old('display_name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('home', 'Menu Accueil :') }} <span class="m--font-danger">*</span>
                {{ Form::select('home', array('1'=>'Oui', '0'=>'Non'), 0, array('class'=>'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Créer un nouveau menu', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('menus.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection