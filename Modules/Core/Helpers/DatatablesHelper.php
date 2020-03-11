<?php

namespace Modules\Core\Helpers;

class DatatablesHelper {



	/**
	 * @param string $route
	 * @param array $col
	 * @return string
	 */
	public static function datatable($route, $col, $options)
	{
		$src = '<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>';


		//LOCALIZATION
        $visibility = __('datatable.datable-header-visibility');
        $next_page = __('datatable.datable-header-footer-next-page');
        $previous_page = __('datatable.datable-header-footer-previous-page');
        $info = __('datatable.datable-header-footer-info', ['START'=>'_START_', 'END'=>'_END_', 'TOTAL'=>'_TOTAL_']);
        //END LOCALIZATION

        //STORAGE PATH
        $storage_path = asset('/storage');

		$columns = "{data: 'checkbox', name: 'checkbox', title: '<input name=\"select_all\" value=\"1\" id=\"select-all\" type=\"checkbox\" />'},
          			{data: 'id', name: 'id', title: '#'},";

		if ($options == "reorder") {
			$columns = "{data: 'checkbox', name: 'checkbox', title: '<input name=\"select_all\" value=\"1\" id=\"select-all\" type=\"checkbox\" />'},
          				{data: 'position', name: 'position', title: 'Position'},";
		}

		foreach ($col as $variable=>$display)
		{
			if ($variable == "actif"){
				$columns .= "
				{data: 'actif', name: 'actif', title: '$display', render: function(data, type, row, meta) {
					switch(data) {
						case 0:
							return '<span data-col=\"status\" class=\"m-badge m-badge--metal m-badge--wide\" id=\"'+ row.id +'\">Inactif</span>';
							break;
						case '1':
							return '<span data-col=\"status\" class=\"m-badge m-badge--focus m-badge--wide\" id=\"'+ row.id +'\">Actif</span>';
							break;
						default:
							break;
					}
				}},";
			} elseif ($variable == "handled"){
				$columns .= "
				{data: 'handled', name: 'handled', title: '$display', render: function(data, type, row, meta) {
					switch(data) {
						case 0:
							return '<span data-col=\"handled\" data-handled=\"false\" class=\"m-badge m-badge--warning m-badge--wide\" id=\"'+ row.id +'\">Non</span>';
							break;
						case '1':
							return '<span data-col=\"handled\" data-handled=\"true\" class=\"m-badge m-badge--success m-badge--wide\" id=\"'+ row.id +'\">Oui</span>';
							break;
						default:
							break;
					}
				}},";
			} elseif ($variable == "photo") {
				$columns .= "{data: 'uuid', name: 'uuid', title: '$display', render: function(data, type, row, meta) {
                        return '<img data-col=\"apercu\" style=\"max-height: 400px; max-width: 400px\" src=\"$storage_path/' + data + '\" id=\"'+ row.id +'\"/>'
                    }},";
			} elseif ($variable == "image") {
                $columns .= "{data: 'image', name: 'image', title: '$display', render: function(data, type, row, meta) {
                        if (data === null) {
                        	return '<span class=\"fa-stack fa-lg\"><i class=\"fa fa-camera fa-stack-2x\"></i><i class=\"fa fa-ban fa-stack-2x text-danger\"></i></span>';
						}
						else
						{
							return '<img data-col=\"apercu\" style=\"max-height: 400px; max-width: 400px\" src=\"$storage_path/' + data + '\" id=\"'+ row.id +'\"/>';
						}
                    }},";
            }elseif ($variable == "backoffice") {
				$columns .= "                
				{data: 'backoffice', name: 'backoffice', title: 'BO', render: function(data, type, row, meta) {
					switch(data) {
						case 0:
							return '<span data-col=\"backoffice\" data-bo=\"false\" class=\"m-badge m-badge--metal m-badge--wide\" id='+ row.id +'><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></span>';
							break;
						case '1':
							return '<span data-col=\"backoffice\" data-bo=\"true\" class=\"m-badge m-badge--warning m-badge--wide\" id='+ row.id +'><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></span>';
							break;
						default:
							break;
					}
				}},";
			} elseif ($variable == "selected") {
				$columns .= "                
				{data: 'selected', name: 'selected', title: '$display', render: function(data, type, row, meta) {
					switch(data) {
						case 0:
							return '<span data-col=\"selected\" data-selected=\"false\" class=\"m-badge m-badge--metal m-badge--wide\" id='+ row.id +'><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></span>';
							break;
						case '1':
							return '<span data-col=\"selected\" data-selected=\"true\" class=\"m-badge m-badge--warning m-badge--wide\" id='+ row.id +'><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></span>';
							break;
						default:
							break;
					}
				}},";
			} elseif ($variable == "level") {
				$columns .= "                
				{data: 'level', name: 'level', title: '$display', render: function(data, type, row, meta) {
					switch(data) {
						case '1':
							return '<p style=\"padding-left: 0; text-align: left; width: 410px\"><button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-up\"></i></button>	<button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-down\"></i></button></p>';
							break;
						case '2':
							return '<p style=\"padding-left: 25%; text-align: left; width: 410px\"><button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-up\"></i></button>	<button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-down\"></i></button></p>';
							break;
						case '3':
							return '<p style=\"padding-left: 50%; text-align: left; width: 410px\"><button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-up\"></i></button>	<button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-down\"></i></button></p>';
							break;
						case '4':
							return '<p style=\"padding-left: 75%; text-align: left; width: 410px\"><button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-up\"></i></button>	<button class=\"btn btn-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill\"><i class=\"la la-angle-down\"></i></button></p>';
							break;
						default:
							break;
					}
				}},";
			} else {
				$columns .= "{data: '$variable', name: '$variable', title: '$display'},";
			}
		}
		$columns .= "{data: 'action', name: 'action', title:'Actions', orderable: false, searchable: false}";

		$reorder = "";
		if ($options == "reorder")
		{
			$src .= "<script src=\"https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js\"></script>";
			$reorder = "rowReorder: {
           					selector: 'tr'
       					},";
		}

		$table = "
		<script>
			var table = $('#datatable').DataTable({
				processing: true,
				serverSide: true,
				pageLength: 25,
				dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'colvis',
                    columns: ':gt(0)',
                    text: '$visibility',
                     columnText: function ( dt, idx, title ) {
                        return (idx)+': '+title;
                    }
                },
                
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                 {
                extend: 'excelHtml5',
                exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                extend: 'csvHtml5',
                exportOptions: {
                        columns: ':visible'
                    }
                },
                
            ],
                language: {
				    'info': '$info',
                    'paginate': {
                        'previous': '$previous_page',
                        'next' : '$next_page'
                    }
                },
                $reorder
				ajax: '$route',
					'columnDefs': [{
						'targets': 0,
						'searchable':false,
						'orderable':false,
						'className': 'dt-body-center',
						'render': function (data, type, full, meta)
						{
							return '<input type=\"checkbox\" name=\"id[]\" value=\"' + full.id + '\" + id=\"' + full.id + '\">';
						}
					}],
					'order': [1, 'asc'],
				columns: [ $columns ]
			});
			
			table.on( 'row-reorder', function ( e, diff, edit ) { 
				for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
				    
				    var rowData = table.row( diff[i].node ).data();
				    console.log(rowData['id'], diff[i].newPosition);
				    updateModelPosition(rowData['id'], diff[i].newPosition);
				}
    		});
		</script>
		
	";

		return "$src.$table";
	}

	/**
	 * @return string
	 */
	public static function action_groupe_html()
	{
		return "
		<div class=\"btn-group dropup open\">
			<a class=\"btn btn-default btn-circle\" href=\"#\" data-toggle=\"dropdown\" aria-expanded=\"true\"><span class=\"hidden-480\">Actions groupées  <i class=\"fa fa-angle-up\"></i></span></a>
			<ul class=\"dropdown-menu pull-right\">
				<li><a class=\"activeall\" href=\"javascript:;\" data-action=\"activeall\"><i class=\"fa fa-toggle-on\"></i> Activer </a></li>
				<li><a class=\"disableall\" href=\"javascript:;\" data-action=\"disableall\"><i class=\"fa fa-toggle-off\"></i> Désactiver </a></li>
				<li><a class=\"deleteall\" href=\"javascript:;\" data-action=\"deleteall\"><i class=\"fa fa-trash\"></i> Supprimer </a></li>
			</ul>
		</div>
		";
	}

	/**
	 * @param string $model
	 * @param string $options
	 * @return string
	 */
	public static function action_groupe_js($model, $options)
	{
		if ($model == 'news') {
			$model_singulier = $model;
		} else {
			$model_singulier = substr($model, 0, -1);
		}

		//LOCALIZATION
		$error = __('message.error');
        $success_enable = __('message.success_enable', ['model' => $model_singulier]);
		$success_disable = __('message.success_disable', ['model' => $model_singulier]);
        $succes_delete = __('message.succes_delete', ['model' => $model_singulier]);
        $succes_updateModelPosition = __('message.succes_updateModelPosition');
        $succes_backoffice = __('message.succes_backoffice');
        $succes_frontoffice = __('message.succes_frontoffice');
        $succes_select = __('message.succes_select');
        $success_unselect = __('message.success_unselect');
        $success_handled = __('message.success_handled');
        $success_nohandled = __('message.success_nohandled');
        $success_removeModel_domain = __('message.success_removeModel_domain');
        $success_removeModel_subscriber = __('message.success_removeModel_subscriber');
        //END LOCALIZATION


		$url = url('/')."/admin/".$model."/";
		$csrf_token = csrf_token();

		$js = "
    <script>
		$('#select-all').on('click', function(){
			var rows = table.rows({ 'search': 'applied' }).nodes();
			$('input[type=\"checkbox\"]', rows).prop('checked', this.checked);
		});
		$('#datatable tbody').on('change', 'input[type=\"checkbox\"]', function(){
			if(!this.checked){
				var el = $('#example-select-all').get(0);
				if(el && el.checked && ('indeterminate' in el)){
						el.indeterminate = true;
				}
			}
		});
    </script>
		<script>
			function enableModel(target){
				$.ajax({
					type:'PUT',
					url:'$url'+ target.attr('id') + '/enable',
					dataType: 'json',
					headers: { 'X-CSRF-TOKEN': '$csrf_token' },
					success: function (data) {
						table.ajax.reload();
						toastr.success(\"$success_enable\");
					},
					error: function (data) {
						toastr.error(\"$error\");
					},
				});
			}

			function disableModel(target){
				$.ajax({
					type:'PUT',
					url:'$url'+ target.attr('id') + '/disable',
					dataType: 'json',
					headers: { 'X-CSRF-TOKEN': '$csrf_token' },
					success: function (data) {
						table.ajax.reload();
						toastr.warning(\"$success_disable\");
					},
					error: function (data) {
						toastr.error(\"$error\");
					},
				});
			}

			function deleteModel(target){
				$.ajax({
					type:'DELETE',
					url:'$url'+ target.attr('id'),
					dataType: 'json',
					headers: { 'X-CSRF-TOKEN': '$csrf_token' },
					success: function (data) {
						table.row(target.parents('tr'))
							.remove()
							.draw();
						toastr.warning(\"$succes_delete\");
					},
					error: function (data) {
						toastr.error(\"$error\");
					},
				});
			}
			
			function updateModelPosition(model_id, position){
				$.ajax({
					type:'PUT',
					url:'$url'+ model_id + '/position/' + position,
					dataType: 'json',
					headers: { 'X-CSRF-TOKEN': '$csrf_token' },
					success: function (data) {
						//table.ajax.reload();
						toastr.warning(\"$succes_updateModelPosition\");
					},
					error: function (data) {
						console.log(data);
						toastr.error(\"$error\");
					},
				});
			}
    </script>
		<script>
        $( \"#datatable\" ).on('click', '.m-badge', function() {
            if ($(this).data('col') === \"status\") {
                if ($(this).text() === \"Actif\") {
                    disableModel($(this));
                } else {
                    enableModel($(this));
                }
            }
        });
        $( \"#datatable\" ).on('click', '.m-btn--pill', function() {
        	if ($(this).data('action') === \"delete\") {
            	deleteModel($(this));
			}
        });


        /* Actions groupées */
        $(\".disableall\").click(function(){
            table.$('input:checked[type=\"checkbox\"]').each(function(){
                disableModel($(this));
            });
        });
        $(\".activeall\").click(function(){
            table.$('input:checked[type=\"checkbox\"]').each(function(){
                enableModel($(this));
            });
        });
        $(\".deleteall\").click(function(){
            table.$('input:checked[type=\"checkbox\"]').each(function(){
                deleteModel($(this));
            });
        });
    </script>
		";

		if ($options == "fields")
		{
			$js .= "
		<script>
        function backOffice(target){
			$.ajax({
				type:'PUT',
				url:'$url'+ target.attr('id') + '/backoffice',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': '$csrf_token' },
				success: function (data) {
					table.ajax.reload();
					toastr.success(\"$succes_backoffice\");
				},
				error: function (data) {
					console.log(data);
					toastr.error(\"$error\");
				},
			});
        }
        function frontOffice(target){
			$.ajax({
				type:'PUT',
				url:'$url'+ target.attr('id') + '/frontoffice',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': '$csrf_token' },
				success: function (data) {
					table.ajax.reload();
					toastr.warning(\"$succes_frontoffice\");
				},
				error: function (data) {
					console.log(data);
					toastr.error(\"$error\");
				},
			});
        }
		</script>
		<script>
			$( \"#datatable\" ).on('click', '.m-badge', function() {
				if ($(this).data(\"col\") === \"backoffice\") {
					if ($(this).data(\"bo\") === true) {
						frontOffice($(this));
					} else {
						backOffice($(this));
					}
				}
			});
		</script>";
		}
        elseif ($options == "choices")
        {
            $js .= "
		<script>
        function select(target){
			$.ajax({
				type:'PUT',
				url:'$url'+ target.attr('id') + '/select',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': '$csrf_token' },
				success: function (data) {
					table.ajax.reload();
					toastr.success(\"$succes_select\");
				},
				error: function (data) {
					console.log(data);
					toastr.error(\"$error\");
				},
			});
        }
        function unselect(target){
			$.ajax({
				type:'PUT',
				url:'$url'+ target.attr('id') + '/unselect',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': '$csrf_token' },
				success: function (data) {
					table.ajax.reload();
					toastr.warning(\"$success_unselect\");
				},
				error: function (data) {
					console.log(data);
					toastr.error(\"$error\");
				},
			});
        }
		</script>
		<script>
			$( \"#datatable\" ).on('click', '.m-badge', function() {
				if ($(this).data(\"col\") === \"selected\") {
					if ($(this).data(\"selected\") === true) {
						unselect($(this));
					} else {
						select($(this));
					}
				}
			});
		</script>
	";
        }
		elseif ($options == "answers")
		{
			$js .= "
		<script>
        function handled(target){
			$.ajax({
				type:'PUT',
				url:'$url'+ target.attr('id') + '/handled',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': '$csrf_token' },
				success: function (data) {
					table.ajax.reload();
					toastr.success(\"$success_handled\");
				},
				error: function (data) {
					console.log(data);
					toastr.error(\"$error\");
				},
			});
        }
        function noHandled(target){
			$.ajax({
				type:'PUT',
				url:'$url'+ target.attr('id') + '/nohandled',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': '$csrf_token' },
				success: function (data) {
					table.ajax.reload();
					toastr.warning(\"$success_nohandled\");
				},
				error: function (data) {
					console.log(data);
					toastr.error(\"$error\");
				},
			});
        }
		</script>
		<script>
			$( \"#datatable\" ).on('click', '.m-badge', function() {
				if ($(this).data(\"col\") === \"handled\") {
					if ($(this).data(\"handled\") === true) {
						noHandled($(this));
					} else {
						handled($(this));
					}
				}
			});
		</script>
	";
		}
		elseif ($options == "agence_domain")
		{
			$js .= "
				<script>
				function removeModel(target){
					$.ajax({
						type:'DELETE',
						url:'$url'+'domains/'+ target.attr('id')+'/'+target.data('agence_id'),
						dataType: 'json',
						headers: { 'X-CSRF-TOKEN': '$csrf_token' },
						success: function (data) {
							table.row(target.parents('tr'))
								.remove()
								.draw();
							toastr.warning(\"$success_removeModel_domain\");
						},
						error: function (data) {
							toastr.error(\"$error\");
						},
					});
					}
				</script>
				<script>
					$( \"#datatable\" ).on('click', '.m-btn--pill', function() {
						if ($(this).data('action') === \"remove\") {
							removeModel($(this));
					}
				});
				</script>
			";
		}
		elseif ($options == "subscriber_group")
        {
            $js .= "
				<script>
				function removeModel(target){
					$.ajax({
						type:'DELETE',
						url:'$url'+'groups/'+ target.attr('id')+'/'+target.data('subscriber_id'),
						dataType: 'json',
						headers: { 'X-CSRF-TOKEN': '$csrf_token' },
						success: function (data) {
							table.row(target.parents('tr'))
								.remove()
								.draw();
							toastr.warning(\"$success_removeModel_subscriber\");
						},
						error: function (data) {
							toastr.error(\"$error\");
						},
					});
					}
				</script>
				<script>
					$( \"#datatable\" ).on('click', '.m-btn--pill', function() {
						if ($(this).data('action') === \"remove\") {
							removeModel($(this));
					}
				});
				</script>
			";
        }
		return $js;
	}

}