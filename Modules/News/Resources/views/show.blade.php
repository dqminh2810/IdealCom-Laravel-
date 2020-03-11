@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Prévisualisation: {{ $news->title }}
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
            <a href="{{ route('news.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Actualités</span>
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
            <h2 class="text-center">Titre :</h2>
            <div class="jumbotron text-center">
                {{ $news->title }}
            </div>
            <h2 class="text-center">Contenu :</h2>
            <div class="jumbotron">
                {!! $news->content !!}
            </div>
        </div>
    </div>
@stop