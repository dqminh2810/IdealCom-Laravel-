@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endpush

@section('title')
    Gestion des documents
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
                        <a href="{{ route('documents.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
						<span>
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
							<span>Créer un document</span>
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
            <div class="btn-group dropup open">
                <a class="btn btn-default btn-circle" href="#" data-toggle="dropdown" aria-expanded="true"><span class="hidden-480">Actions groupées  <i class="fa fa-angle-up"></i></span></a>
                <ul class="dropdown-menu pull-right">
                    <li><a class="activeall" href="javascript:;" data-action="activeall"><i class="fa fa-toggle-on"></i> Activer </a></li>
                    <li><a class="disableall" href="javascript:;" data-action="disableall"><i class="fa fa-toggle-off"></i> Désactiver </a></li>
                    <li><a class="deleteall" href="javascript:;" data-action="deleteall" data-content="Etes-vous sûr(e) de vouloir supprimer <strong>tous les utilisateurs sélectionnés</strong> ?"><i class="fa fa-trash"></i> Supprimer </a></li>
                </ul>
            </div>
            {!! actions_groupe_html() !!}
            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('js')
    {!!
        datatable(route('datatables.formulaires'),
        array('title'=>'Titre', 'description'=>'Description', 'uuid'=>'UUID', 'title'=>'Titre', 'actif'=>'Actif', 'created_at'=>'Créé le', 'updated_at'=>'Mis à jour le'))
    !!}
    {!! actions_groupe_js('documents') !!}
@endpush
