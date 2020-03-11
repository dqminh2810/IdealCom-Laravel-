@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le document : {{ $document->title }}
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
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Médias</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('documents.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Documents</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Editer un document</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($document, array('url' => route('documents.update', $document->id), 'method'=> 'PUT', 'files' => true)) }}
            <div class="form-group">
                {{ Form::label('title', 'Titre :') }} <span class="m--font-danger">*</span>
                {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('document', 'Fichier :') }} <span class="m--font-danger">*</span>
                {{ Form::file('document', array('class' => 'form-control', 'accept' => '.pdf,.doc,.odt,.docx', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description :') }}
                {{ Form::text('description', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('documents.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection