@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endpush

@section('title')
    Gestion des langages
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
            <a href="{{ route('languages.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Langages</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
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
        datatable(route('datatables.languages'),
        array('code'=>'Code', 'name'=>'Nom', 'native_name'=>'Nom natif','actif'=>'Status'))
    !!}
    {!! actions_groupe_js('languages') !!}
@endpush

