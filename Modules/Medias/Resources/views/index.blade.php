@extends('medias::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('medias.name') !!}
    </p>
@stop
