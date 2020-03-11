@extends(Theme::get()['name'].'::admin.layouts.master')

@section('title')
    Modifier l'abonné : {{ $subscriber->name }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('Image-Select-master/src/chosen/chosen.css')}}" />
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
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Modifier un abonné</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::model($subscriber, array('route' => array('subscribers.update', $subscriber->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('subscriber_name', 'Nom :') }} <span class="m--font-danger">*</span>
                {{ Form::text('subscriber_name', null, array('class' => 'form-control', 'required')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email :') }} <span class="m--font-danger">*</span>
                {{ Form::text('email', null, array('class' => 'form-control', 'required')) }}
            </div>

            {{ Form::submit('Appliquer les modifications', array('class' => 'btn btn-primary', 'id' => 'editer')) }}
            <a class="btn btn-warning" href="{{ route('subscribers.index') }}">Annuler</a>
            {{ Form::close() }}
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-beta.3/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script src="{{ asset('Image-Select-master/src/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('Image-Select-master/src/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
    <script src="{{ asset('Image-Select-master/src/ImageSelect.jquery.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".my-select").chosen({width:"100%"});
    </script>
@endpush