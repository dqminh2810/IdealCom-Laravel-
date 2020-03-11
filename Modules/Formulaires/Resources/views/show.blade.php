@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Prévisualisation : {{ $formulaire->title }} ({{ $formulaire->uuid }})
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
            <a href="{{ route('formulaires.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Formulaires</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Prévisualiser un formulaire</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            {!! formbuilder($formulaire->uuid)  !!}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <h3>Formulaire</h3>
            <pre>
                {{ prettify($formulaire) }}
            </pre>

            <h3>Champs</h3>
            <pre>
                {{ prettify($formulaire->fields) }}
            </pre>
        </div>
    </div>
@endsection