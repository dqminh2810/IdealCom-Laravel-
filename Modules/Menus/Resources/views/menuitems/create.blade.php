@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Création d'un menuitem pour le menu : {{ $menu->display_name }}
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
            <a href="{{ route('menuitems.show', $menu) }}" class="m-nav__link">
                <span class="m-nav__link-text">MenuItems</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Créer un MenuItem</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('menuitems.store'))) }}
            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('display_name', 'Désignation :') }} <span class="m--font-danger">*</span>
                {{ Form::text('display_name', old('display_name'), array('class' => 'form-control', 'required')) }}
            </div>

            {{ Form::hidden('menu_id', $menu->id, array('class' => 'form-control')) }}
            {{ Form::hidden('parent_id', isset($menuitem->id) ? $menuitem->id : 0, array('class' => 'form-control')) }}

            <div class="form-group">
                {{ Form::label('hidden', 'Invisible :') }} <span class="m--font-danger">*</span>
                {{ Form::select('hidden', array('1'=>'Oui', '0'=>'Non'), old('hidden'), array('class' => 'form-control', 'required', 'placeholder'=>'Sélectionner ...')) }}
            </div>

            <div class="form-group">
                {{ Form::label('readonly', 'Clickable :') }} <span class="m--font-danger">*</span>
                {{ Form::select('readonly', array('0'=>'Oui', '1'=>'Non'), old('readonly'), array('class' => 'form-control', 'required', 'placeholder'=>'Sélectionner ...')) }}
            </div>

            <div class="form-group">
                {{ Form::label('url', 'Lien :') }}
                {{ Form::url('url', old('url'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('target', 'Lien :') }} <span class="m--font-danger">*</span>
                {{ Form::select('target', array('_self'=>'Même fenêtre', '_blank'=>'Autre fenêtre'), old('target'), array('class' => 'form-control', 'required', 'placeholder'=>'Sélectionner ...')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Créer un nouveau menuitem', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('menus.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection