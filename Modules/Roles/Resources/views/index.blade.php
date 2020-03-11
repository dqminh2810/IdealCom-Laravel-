@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endpush

@section('title')
    Gestion des rôles
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
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
						<span>
							<i class="fa fa-address-card-o" aria-hidden="true"></i>
							<span>Créer un rôle</span>
						</span>
                        </a>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
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
        datatable(route('datatables.roles'),
        array('name'=>'Nom', 'display_name'=>'Nom affiché', 'description'=>'Description', 'actif'=>'Actif', 'created_at'=>'Créé le', 'updated_at'=>'Mis à jour le'))
    !!}
    {!! actions_groupe_js('roles') !!}
@endpush
