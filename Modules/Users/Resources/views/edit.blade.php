@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-duallistbox.css') }}" />
@endpush

@section('title')
    Editer l'utilisateur : {{ $user->name }}
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
            <a href="{{ route('users.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Utilisateurs</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Editer un utilisateur</span>
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

            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('email', 'Email :') }} <span class="m--font-danger">*</span>
                {{ Form::email('email', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Mot de passe :') }}
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', 1) }}
            </div>
            @permission('admin-users-roles')
            <div class="form-group">
                {{ Form::select('roles[]', \App\Role::pluck('display_name','name'), $user->roles()->get()->pluck('name'), array('multiple'=>'multiple', 'id'=>'dualbox', 'name'=>'roles[]', 'size'=>'20')) }}
            </div>
            @endpermission

            {{ Form::submit('Appliquer les modifications', array('class' => 'btn btn-primary', 'id' => 'editer')) }}
            <a class="btn btn-warning" href="{{ route('users.index') }}">Annuler</a>
            {{ Form::close() }}
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.js') }}"></script>
    <script>
        $("#dualbox").bootstrapDualListbox({
            nonSelectedListLabel: 'Rôles disponibles',
            selectedListLabel: 'Rôles liées à l\'utilisateur',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
            helperSelectNamePostfix: false,
        });
    </script>
@endpush