@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer l'agence : {{ $agence->name }}
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
                <span class="m-nav__link-text">Editer une agence</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($agence, array('url' => route('agences.update', $agence->id), 'method'=>'PUT')) }}
            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('web_agence', 'Agence Web :') }} <span class="m--font-danger">*</span>
                {{ Form::select('web_agence', array('1'=>'Oui', '0'=>'Non'), null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('address', 'Adresse :') }}
                {{ Form::text('address', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('complement', 'Complément :') }}
                {{ Form::text('complement', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('zip_code', 'Code postal :') }}
                {{ Form::text('zip_code', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('city', 'Ville :') }}
                {{ Form::text('city', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('country_id', 'Pays :') }}
                {{ Form::select('country_id', \Modules\Countries\Facades\CountriesFacade::getArrayCountry(), null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('website', 'Site :') }}
                {{ Form::url('website', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email de contact :') }}
                {{ Form::email('email', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('agences.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection