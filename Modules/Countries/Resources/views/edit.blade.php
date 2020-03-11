@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le domaine : {{ $country->name }}
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
            <a href="{{ route('countries.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Pays</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Editer un pays</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($country, array('url' => route('countries.update', $country->id), 'method'=>'PUT')) }}
            <div class="form-group">
                {{ Form::label('code', 'Code Numérique:') }} <span class="m--font-danger">*</span>
                {{ Form::text('code', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('alpha2', 'Code Alpha-2 :') }} <span class="m--font-danger">*</span>
                {{ Form::text('alpha2', null, array('class' => 'form-control', 'required', 'min'=>'2', 'max'=>'2')) }}
            </div>

            <div class="form-group">
                {{ Form::label('alpha3', 'Code Alpha-3 :') }} <span class="m--font-danger">*</span>
                {{ Form::text('alpha3', null, array('class' => 'form-control', 'required', 'min'=>'3', 'max'=>'3')) }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('countries.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection