@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-duallistbox.css') }}" />
@endpush

@section('title')
    Créer un nouveau rôle
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
                <span class="m-nav__link-text">Créer un rôle</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('roles.store'))) }}

            <div class="form-group">
                {{ Form::label('name', 'Rôle :') }} <span class="m--font-danger">*</span>
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

            <div class="form-group">
                {{ Form::select('permissions[]', \App\Permission::pluck('display_name','name'), null, array('multiple'=>'multiple', 'id'=>'dualbox', 'name'=>'permissions[]', 'size'=>'25')) }}
            </div>

            {{ Form::submit('Créer un nouveau rôle', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('roles.index') }}">Annuler</a>
            {{ Form::close() }}
        </div>
    </div>

@stop

@push('js')
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.js') }}"></script>
    <script>
        $("#dualbox").bootstrapDualListbox({
            nonSelectedListLabel: 'Permissions disponibles',
            selectedListLabel: 'Permissions liées au rôle',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
            helperSelectNamePostfix: false,
        });
    </script>
@endpush