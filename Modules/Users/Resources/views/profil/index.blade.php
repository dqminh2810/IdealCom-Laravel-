@extends(Theme::get()['name'].'::admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-duallistbox.css') }}" />
@endpush

@section('title')
        Mon Profil
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
            <a href="{{ route('profils.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Mon profil</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Mon profil
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{asset('/storage/avatar/')}}/{{$user->id}}" alt="">
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name">{{$user->name}}</span>
                                    <span class="m-card-profile__details">Modifier mon avatar</span>
                                    {{ Html::ul($errors->all()) }}
                                    {{ Form::model($user, array('route' => array('profils.update', $user->id), 'method' => 'PUT', 'files' => true)) }}
                                    {{ Form::file('avatar', array('class' => 'form-control', 'accept' => '.jpeg, .png, .jpg')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--mobile">
                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__group--last">Détails Personnels</h3>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ Form::label('name', 'Nom :') }} <span class="m--font-danger">*</span></label>
                                    <div class="col-7">
                                        {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ Form::label('telephone', 'Telephone :') }}<span class="m--font-danger">*</span></label>

                                    <div class="col-7">
                                        {{ Form::text('telephone', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__group--last">Adresse</h3>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ Form::label('address', 'Address :') }}<span class="m--font-danger">*</span></label>
                                    <div class="col-7">
                                        {{ Form::text('address', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ Form::label('city', 'City :') }}<span class="m--font-danger">*</span></label>
                                    <div class="col-7">
                                        {{ Form::text('city', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ Form::label('country', 'Country :') }}<span class="m--font-danger">*</span></label>
                                    <div class="col-7">
                                        {{ Form::text('country', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__group--last">Réseaux Sociaux</h3>
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ Form::label('website', 'Website :') }}<span class="m--font-danger">*</span></label>
                                    <div class="col-7">
                                        {{ Form::text('website', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>


                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    {{ Form::submit('Appliquer les modifications', array('class' => 'btn btn-primary', 'id' => 'editer')) }}
                                    <a class="btn btn-warning" href="{{ route('admin.dashboard') }}">Annuler</a>
                                    {{ Form::close() }}
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </div>

@stop

@push('js')
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.js') }}"></script>
@endpush