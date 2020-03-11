@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Créer une nouvelle permission
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
            <a href="{{ route('permissions.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Permissions</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Créer une permission</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('permissions.store'))) }}

            <div class="form-group">
                {{ Form::label('name', 'Permission :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('display_name', 'Nom affiché :') }}
                {{ Form::text('display_name', old('display_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description :') }}
                {{ Form::text('description', old('description'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1', true) }}
            </div>

            {{ Form::submit('Créer un nouvelle permission', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('permissions.index') }}">Annuler</a>
            {{ Form::close() }}
        </div>
    </div>

@stop