@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Editer le modèle : {{ $cookie->title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-colorpicker.css') }}">
    <style>
        .colorpicker-2x .colorpicker-saturation {
            width: 150px;
            height: 150px;
        }

        .colorpicker-2x .colorpicker-hue,
        .colorpicker-2x .colorpicker-alpha {
            width: 30px;
            height: 150px;
        }

        .colorpicker-2x .colorpicker-preview,
        .colorpicker-2x .colorpicker-preview div {
            height: 30px;
            font-size: 16px;
            line-height: 160%;
        }

        .colorpicker-saturation .colorpicker-guide,
        .colorpicker-saturation .colorpicker-guide i {
            height: 10px;
            width: 10px;
            border-radius: 10px;
        }
    </style>
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
            <a href="{{ route('cookies.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Cookies</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Editer un modèle</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            {{ Html::ul($errors->all()) }}

            {{ Form::model($cookie, array('url' => route('cookies.update', $cookie->id), 'method'=>'PUT')) }}
            <div class="form-group">
                {{ Form::label('title', 'Titre :') }} <span class="m--font-danger">*</span>
                {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('position', 'Position :') }}<br>
                {{ Form::radio('position', 'bottom') }} Bottom
                <span> - </span>
                {{ Form::radio('position', 'top') }} Top
            </div>

            <div class="form-group">
                {{ Form::label('banner_text', 'Texte de la bannière :') }}
                {{ Form::text('banner_text', null, array('class' => 'form-control', 'placeholder' => 'Nous utilisons des cookies pour optimiser votre expérience sur notre site.')) }}
            </div>

            <div class="form-group">
                {{ Form::label('button_text', 'Texte du bouton :') }}
                {{ Form::text('button_text', null, array('class' => 'form-control', 'placeholder' => 'Accepter')) }}
            </div>

            <div class="form-group">
                {{ Form::label('link', 'Adresse du lien pour en savoir plus sur l\'utilisation des cookies :') }}
                {{ Form::text('link', null, array('class' => 'form-control', 'placeholder' => 'https://cookiesandyou.com/')) }}
            </div>

            <div class="form-group">
                {{ Form::label('banner_color', 'Couleur de la bannière :') }}
                {{ Form::text('banner_color', null, array('class' => 'form-control', 'placeholder' => '#edeff5')) }}
            </div>

            <div class="form-group">
                {{ Form::label('banner_text_color', 'Couleur du texte dans la bannière :') }}
                {{ Form::text('banner_text_color', null, array('class' => 'form-control', 'style'=>'height: 50px', 'placeholder' => '#8383a8')) }}
            </div>

            <div class="form-group">
                {{ Form::label('button_color', 'Couleur du bouton :') }}
                {{ Form::text('button_color', null, array('class' => 'form-control', 'style'=>'height: 50px', 'placeholder' => '#4b81e8')) }}
            </div>

            <div class="form-group">
                {{ Form::label('button_text_color', 'Couleur du texte dans le bouton :') }}
                {{ Form::text('button_text_color', null, array('class' => 'form-control', 'style'=>'height: 50px', 'placeholder' => '#ffffff')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actif', 'Actif :') }}
                {{ Form::checkbox('actif', '1') }}
            </div>

            {{ Form::submit('Enregistrer les modifications', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-warning" href="{{ route('cookies.index') }}">Annuler</a>

            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#banner_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 150,
                        maxTop: 150
                    },
                    hue: {
                        maxTop: 150
                    },
                    alpha: {
                        maxTop: 150
                    }
                }
            });
            $('#banner_text_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 150,
                        maxTop: 150
                    },
                    hue: {
                        maxTop: 150
                    },
                    alpha: {
                        maxTop: 150
                    }
                }
            });
            $('#button_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 150,
                        maxTop: 150
                    },
                    hue: {
                        maxTop: 150
                    },
                    alpha: {
                        maxTop: 150
                    }
                }
            });
            $('#button_text_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 150,
                        maxTop: 150
                    },
                    hue: {
                        maxTop: 150
                    },
                    alpha: {
                        maxTop: 150
                    }
                }
            });
        });
    </script>
@endpush