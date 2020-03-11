@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Créer un nouveau abonné
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
            <a href="{{ route('subscribers.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Abonnés</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Créer un nouveau abonné</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => route('subscribers.store'))) }}

            <div class="form-group">
                {{ Form::label('subscriber_name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('subscriber_name', old('subscriber_name'), array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email :') }} <span class="m--font-danger">*</span>
                {{ Form::text('email', old('email'), array('class' => 'form-control', 'required')) }}
            </div>

            {{ Form::submit('Créer un nouveau abonné', array('class' => 'btn btn-primary', 'id' => 'creer')) }}
            <a class="btn btn-warning" href="{{ route('subscribers.index') }}">Annuler</a>
            {{ Form::close() }}
        </div>
    </div>
@stop


