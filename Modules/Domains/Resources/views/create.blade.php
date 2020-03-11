@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Création d'un domaine
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
            <a href="{{ route('domains.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Domaines</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Créer un domaine</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('domains.store'))) }}
            <div class="form-group">
                {{ Form::label('code', 'Code :') }} <span class="m--font-danger">*</span>
                {{ Form::text('code', old('code'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('country_id', 'Pays :') }} <span class="m--font-danger">*</span>
                {{ Form::select('country_id', \Modules\Countries\Facades\CountriesFacade::getArrayCountry(), 75, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('name', 'Domaine :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('display_name', 'Désignation :') }} <span class="m--font-danger">*</span>
                {{ Form::text('display_name', old('display_name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('extension', 'Extension :') }} <span class="m--font-danger">*</span>
                {{ Form::text('extension', old('extension'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('google_analytics', 'Google Analytics :') }}
                {{ Form::text('google_analytics', old('google_analytics'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('google_webmastertool', 'Google Webmastertools :') }}
                {{ Form::text('google_webmastertool', old('google_webmastertool'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Créer un nouveau modèle', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('domains.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection