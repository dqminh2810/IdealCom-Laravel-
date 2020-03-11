@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Gestion des abonnés: {{ $subscriber->subscriber_name }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('Image-Select-master/src/chosen/chosen.css')}}" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endpush

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
            <a href="{{ route('subscribers.show', $subscriber->id) }}" class="m-nav__link">
                <span class="m-nav__link-text">Gestion des abonnés</span>
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
                    {{ Form::open(array('url' => route('subscribers.groups.add', $subscriber->id))) }}

                    {{ Form::label('group_id', 'Groupe abonné :') }} <span class="m--font-danger">*</span>
                    {{ Form::select('group_id', \Modules\Subscribers\Facades\SubscribersFacade::getArrayGroupsName() , null, array('class' => 'my-select')) }}

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
@stop

@push('js')
    <script src="{{ asset('Image-Select-master/src/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".my-select").chosen({width:"100%"});
    </script>
    {!!
     datatable(route('datatables.groups.subscribers', $subscriber->id),
     array('group_name'=>'Nom du groupe', 'actif'=>'Status'))
    !!}
    {!! actions_groupe_js('subscribers','subscriber_group') !!}
@endpush
