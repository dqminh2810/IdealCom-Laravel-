@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Prévisualisation du rôle: {{ $role->name }} ({{ $role->display_name }})
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
            <a href="{{ route('roles.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Rôles</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Prévisualisation</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">


            {{ Form::open() }}

            <div class="form-group">
                {{ Form::label('name', 'Rôle :') }}
                {{ Form::text('name', $role->name, array('class' => 'form-control', 'disabled')) }}
            </div>

            <div class="form-group">
                {{ Form::label('display_name', 'Nom affiché :') }}
                {{ Form::text('display_name', $role->display_name, array('class' => 'form-control', 'disabled')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description :') }}
                {{ Form::text('description', $role->description, array('class' => 'form-control', 'disabled')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', $role->actif, true, array('disabled')) }}
            </div>

            <div class="form-group">
                {{ Form::label('permissions', 'Permissions du rôle :') }}
                <ul>
                @foreach($role->permissions()->get() as $permissions=>$permission)
                    <li>{{ $permission->display_name }}</li>
                @endforeach
                </ul>
            </div>

            <a class="btn btn-info" href="{{ route('roles.index') }}">Retour sur la liste</a>
            <a class="btn btn-success" href="{{ route('roles.edit', ['role'=>$role]) }}">Editer ce rôle</a>
            {{ Form::close() }}
        </div>
    </div>

@stop