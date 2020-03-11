@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer la permission : {{ $permission->name }} ({{ $permission->display_name }})
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
                <span class="m-nav__link-text">Editer une permissions</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('name', 'Permission :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('display_name', 'Nom affiché :') }}
                {{ Form::text('display_name', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description :') }}
                {{ Form::text('description', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', 1) }}
            </div>

            {{ Form::submit('Appliquer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('permissions.index') }}">Annuler</a>
            {{ Form::close() }}
        </div>
    </div>
@stop