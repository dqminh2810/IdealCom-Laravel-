@extends('metronic::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endpush

@php
//Traitement demande de contact
    use Modules\Formulaires\Entities\Formulaire;
    use \Illuminate\Support\Facades\DB;
    $formulaire = Formulaire::where('uuid', 'CONTACT')->first();
    $answers = $formulaire->answers;
    $answers_total = $answers->count();
    $anwser_handled = $formulaire->answers->where('handled', '=', '1')
                                          ->count();
    $anwser_no_handled = $formulaire->answers->where('handled', '=', '0')
                                          ->count();
    $answers_month = count(DB::select('SELECT * FROM answers WHERE formulaire_id = 1 AND MONTH(created_at) = MONTH(CURRENT_TIMESTAMP ())'));

    //$formulaire->answers->where('MONTH(created_at)', '=', 'MONTH(CURRENT_TIMESTAMP ()')
    //                                     ->count();
    //count(DB::select('SELECT * FROM answers WHERE formulaire_id = 1 AND MONTH(created_at) = MONTH(CURRENT_TIMESTAMP ())'));
    $anwser_rate = $anwser_handled/$answers_total *100;
@endphp


@section('title')
    Dashboard
@endsection

@section('content')
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Demande de contact
                            </h4><br>
                            <span class="m-widget24__desc">
				            Différence depuis le mois dernier
				        </span>
                            <span class="m-widget24__stats m--font-brand">
				            <?php echo $answers_month?>
				        </span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: <?php echo $anwser_rate?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
							Nombre demande traité
						</span>
                            <span class="m-widget24__number">
							<?php echo $anwser_handled?>
					    </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Demandes
                            </h4><br>
                            <span class="m-widget24__desc">
				            Différence depuis le mois dernier
				        </span>
                            <span class="m-widget24__stats m--font-info">
				            1349
				        </span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
							Change
						</span>
                            <span class="m-widget24__number">
							574
					    </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Commandes
                            </h4><br>
                            <span class="m-widget24__desc">
				            Différence depuis le mois dernier
				        </span>
                            <span class="m-widget24__stats m--font-danger">
				            567
				        </span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
							Change
						</span>
                            <span class="m-widget24__number">
							69%
			            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Panier moyen H.T.
                            </h4><br>
                            <span class="m-widget24__desc">
				            Différence depuis le mois dernier
				        </span>
                            <span class="m-widget24__stats m--font-success">
				            276 €
				        </span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
							Change
						</span>
                            <span class="m-widget24__number">
							200€
						</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-6">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Demandes de contact à traiter
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget4">
                        <!--begin: Datatable -->
                        <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded" id="ajax_data" style="">
                            <table class="m_datatable text-center" id="datatable" style="width: 100%"></table>
                        </div>
                        <!--end: Datatable -->
                    </div>

                </div>
                <div class="m-portlet__foot">
                    <div class="m-menu__item m-menu-link-redirect=1" aria-haspopup="true">
                        <a href="{{route('answers.show', $formulaire->id)}}" class="m-menu__link ">
                            <span class="m-menu__link-text">Voir toutes les demandes de contact</span>
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--danger m-portlet--head-solid-bg m-portlet--head-sm ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Commandes à traiter
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget4">
                        <!--begin: Datatable -->
                        <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded" id="ajax_data" style="">
                            <table class="m_datatable text-center" id="datatable" style="width: 100%"></table>
                        </div>
                        <!--end: Datatable -->
                    </div>

                </div>
                <div class="m-portlet__foot">
                    <div class="m-menu__item m-menu-link-redirect=1" aria-haspopup="true">
                        <a href="{{route('answers.show', $formulaire->id)}}" class="m-menu__link ">
                            <span class="m-menu__link-text">Voir toutes les demandes de contact</span>
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $('#datatable').DataTable( {
            processing: true,
            serverSide: true,
            bFilter: false,
            bPaginate: false,
            bLengthChange: false,
            bInfo: false,
            bAutoWidth: false,
            ajax: '{{ route('datatables.answers.nothandled', 1) }}',
            columns: [
                {data: 'id', name: 'id', title: '#',
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='"+"{!! url('admin/answers') !!}"+"/"+oData.id+"/edit"+"'>"+"Demande de contact de "+oData.prenom+' '+oData.nom+"</a>");
                    },
                },
                {data: 'created_at', name: 'created_at', title: 'Crée le'}
            ]
        } );
    </script>
@endpush

