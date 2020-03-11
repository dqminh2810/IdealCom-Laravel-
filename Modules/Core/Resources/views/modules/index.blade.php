@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endpush

@section('title')
    Gestion des modules
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
            <a href="{{ route('modules.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Modules</span>
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
            <div class="btn-group dropup open">
                <a class="btn btn-default btn-circle" href="#" data-toggle="dropdown" aria-expanded="true"><span class="hidden-480">Actions groupées  <i class="fa fa-angle-up"></i></span></a>
                <ul class="dropdown-menu pull-right">
                    <li><a class="activeall" href="javascript:;" data-action="activeall"><i class="fa fa-toggle-on"></i> Activer </a></li>
                    <li><a class="disableall" href="javascript:;" data-action="disableall"><i class="fa fa-toggle-off"></i> Désactiver </a></li>
                    <li><a class="deleteall" href="javascript:;" data-action="deleteall" data-content="Etes-vous sûr(e) de vouloir supprimer <strong>tous les utilisateurs sélectionnés</strong> ?"><i class="fa fa-trash"></i> Supprimer </a></li>
                </ul>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('js')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        var donnees = [
					<?php
                    $i = 0;
					foreach ($modules as $module=>$value) {
						$i++;
						$enabled = 'enabled'; $name = 'name';
						echo "
						{'id': '$i',
						 'name': '$value[$name]',
						 'actif': '$value[$enabled]',
						 },";
					}
					?>
            ];
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: false,
            data: donnees,
            'columnDefs': [{
                'targets': 0,
                'searchable':false,
                'orderable':false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox" name="id[]" value="'
                            + full.id + '" + id="' + full.id + '">';
                }
            }],
            'order': [1, 'asc'],
            columns: [
                {data: 'checkbox', name: 'checkbox', title: '<input name="select_all" value="1" id="select-all" type="checkbox" />'},
                {data: 'id', name: 'id', title: '#'},
                {data: 'name', name: 'name', title: 'Nom'},
                {data: 'actif', name: 'actif', title: 'Status', render: function(data, type, row, meta) {
                        var title = '';
                        var css = '';
                        switch(data) {
                            case '0':
                                title = "Inactif";
                                css = "m-badge--metal";
                                break;
                            case '1':
                                title = "Actif";
                                css = "m-badge--focus";
                                break;
                            default:
                                break;
                        }
                        return '<span class="m-badge ' + css + ' m-badge--wide" id='+ row.id +'>' + title + "</span>"
                    }},
            ]
        });
    </script>
    <script>
        // Handle click on "Select all" control
        $('#select-all').on('click', function(){
            // Check/uncheck all checkboxes in the table
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#datatable tbody').on('change', 'input[type="checkbox"]', function(){
            // If checkbox is not checked
            if(!this.checked){
                var el = $('#example-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if(el && el.checked && ('indeterminate' in el)){
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });
    </script>
@endpush

@push('js')
    <script>
        function setAdmin(target){
            $.ajax({
                type:'PUT',
                url:'{{ url('/') }}'+'/admin/users/'+ target.attr('id') + '/setadmin',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                        table.ajax.reload();
                        toastr.warning("L'utilisateur est désormais admin !");
                },
                error: function (data) {
                    toastr.error("Une erreur est survenue !");
                },
            });
        }
    </script>
    <script>
        function setUser(target){
            $.ajax({
                type:'PUT',
                url:'{{ url('/') }}'+'/admin/users/'+ target.attr('id') + '/setuser',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                        table.ajax.reload();
                        toastr.success("L'utilisateur n'est plus admin !");
                },
                error: function (data) {
                    toastr.error("Une erreur est survenue !");
                },
            });
        }
    </script>
    <script>
        function enableUser(target){
            $.ajax({
                type:'PUT',
                url:'{{ url('/') }}'+'/admin/users/'+ target.attr('id') + '/enable',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                        table.ajax.reload();
                        toastr.success("L'utilisateur est désormais actif !");
                },
                error: function (data) {
                    toastr.error("Une erreur est survenue !");
                },
            });
        }
    </script>
    <script>
        function disableUser(target){
            $.ajax({
                type:'PUT',
                url:'{{ url('/') }}'+'/admin/users/'+ target.attr('id') + '/disable',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                        table.ajax.reload();
                        toastr.warning("L'utilisateur est désormais inactif !");
                },
                error: function (data) {
                    toastr.error("Une erreur est survenue !");
                },
            });
        }
    </script>
    <script>
        function deleteUser(target){
            $.ajax({
                type:'DELETE',
                url:'{{ url('/') }}'+'/admin/users/'+ target.attr('id'),
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                        table.row(target.parents('tr'))
                             .remove()
                             .draw();
                        toastr.warning("L'utilisateur a été supprimé !");
                },
                error: function (data) {
                    toastr.error("Une erreur est survenue !");
                },
            });
        }
    </script>
    <script>
        $( "#datatable" ).on('click', '.m-badge', function() {
            if ($(this).text() == "Actif" || $(this).text() == "Inactif") {
                if ($(this).text() == "Actif") {
                    disableUser($(this));
                } else {
                    enableUser($(this));
                }
            }
            if ($(this).text() == "Utilisateur" || $(this).text() == "Admin") {
                if ($(this).text() == "Utilisateur") {
                    setAdmin($(this));
                } else {
                    setUser($(this));
                }
            }
        });
        $( "#datatable" ).on('click', '.btn-danger', function() {
            deleteUser($(this));
        });


        /* Actions groupées */
        $(".disableall").click(function(){
            table.$('input:checked[type="checkbox"]').each(function(){
                disableUser($(this));
            });
        });
        $(".activeall").click(function(){
            table.$('input:checked[type="checkbox"]').each(function(){
                enableUser($(this));
            });
        });
        $(".deleteall").click(function(){
            table.$('input:checked[type="checkbox"]').each(function(){
                deleteUser($(this));
            });
        });
    </script>
@endpush