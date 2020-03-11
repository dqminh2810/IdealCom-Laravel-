@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-duallistbox.css') }}" />
@endpush

@section('title')
    Créer un nouveau utilisateur
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
                <span class="m-nav__link-text">Créer un utilisateur</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('users.store'))) }}

            <div class="form-group">
                {{ Form::label('email', 'Email :') }} <span class="m--font-danger">*</span>
                {{ Form::email('email', old('email'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group"> <span class="m--font-danger">*</span>
                {{ Form::label('name', 'Nom :') }}
                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Mot de passe :') }} <span class="m--font-danger">*</span>
                {{ Form::password('password', array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1', true) }}
            </div>
            @permission('admin-users-roles')
            <div class="form-group">
                {{ Form::select('roles[]', \App\Role::pluck('display_name','name'), null, array('multiple'=>'multiple', 'id'=>'dualbox', 'name'=>'roles[]', 'size'=>'25')) }}
            </div>
            @endpermission

            {{ Form::submit('Créer un nouveau utilisateur', array('class' => 'btn btn-primary', 'id' => 'creer')) }}
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