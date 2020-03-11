@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Détails de la réponse : {{ $answer->id }} (Formulaire : {{ $answer->formulaire->uuid }})
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
            <a href="{{ route('answers.show', $answer->formulaire->id) }}" class="m-nav__link">
                <span class="m-nav__link-text">Réponses</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Détails d'une réponse</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            {!! formbuilder($answer->formulaire->uuid, 'PUT', 'true', $answer->id)  !!}
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(":input").attr("readonly", "readonly");
        $("select").attr("disabled", "disabled");
        $("button[type=submit]").hide();
    </script>
@endpush