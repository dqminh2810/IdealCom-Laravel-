@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Création d'une agence
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
            <a href="{{ route('agences.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Agences</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Créer une agence</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('agences.store'))) }}
            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('web_agence', 'Agence Web :') }} <span class="m--font-danger">*</span>
                {{ Form::select('web_agence', array('1'=>'Oui', '0'=>'Non'), 0, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('address', 'Adresse :') }}
                {{ Form::text('address', old('address'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('complement', 'Complément :') }}
                {{ Form::text('complement', old('complement'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('zip_code', 'Code postal :') }}
                {{ Form::text('zip_code', old('zip_code'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('city', 'Ville :') }}
                {{ Form::text('city', old('city'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('country_id', 'Pays :') }}
                {{ Form::select('country_id', \Modules\Countries\Facades\CountriesFacade::getArrayCountry(), 75, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('website', 'Site :') }}
                {{ Form::url('website', old('website'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email de contact :') }}
                {{ Form::email('email', old('email'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Créer une nouvelle agence', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('agences.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection