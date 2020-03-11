@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endpush

@section('title')
    Gestion des domaines de l'agence : {{ $agence->name }}
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
            <a href="{{ route('agences.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Agences</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('agences.show', $agence->id) }}" class="m-nav__link">
                <span class="m-nav__link-text">Gestion des domaines</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    {{ Html::ul($errors->all()) }}
                    {{ Form::open(array('url' => route('agences.domains.add', $agence->id))) }}


                    {{ Form::label('domain_id', 'Domaine :') }} <span class="m--font-danger">*</span>
                    {{ Form::select('domain_id', \Modules\Domains\Facades\DomainsFacade::getArrayDomains(), null, array('class' => 'form-control', 'placeholder'=>'Sélectionnez ...')) }}


                    {{ Form::submit('Rajouter', array('class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                </div>
            </div>
            <!--end: Search Form -->

            <!--begin: Datatable -->
            <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded" id="ajax_data" style="">
                <table class="m_datatable text-center" id="datatable" style="width: 100%"></table>
            </div>
            {!! actions_groupe_html() !!}
            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('js')
    {!!
        datatable(route('datatables.domains.agences', $agence->id),
        array('display_name'=>'Domain', 'actif'=>'Status'))
    !!}
    {!! actions_groupe_js('agences','agence_domain') !!}
@endpush

