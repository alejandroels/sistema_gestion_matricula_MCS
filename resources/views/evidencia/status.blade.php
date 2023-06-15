@extends('layouts.app')

@section('title', 'Home')

@section('sidebar')


<a href="{{ route('evidencia.showByUser', ['user_id' => auth()->user()->id]) }}"><i class="fa fa-fw fa-home"></i>Mi Evidencia</a>


<br>
<a href="{{ route('evidencia.status', ['user_id' => auth()->user()->id]) }}">Ver estado de la evidencia</a>
@endsection


@section('content')

@if(isset($message))
<div class="alert alert-info"><p>{{ $message }}</p></div>

@else

@switch($evidencia->Estado)

    @case('solicitud')
        <div class="alert alert-info">Su solicitud ha sido enviada</div>
        @break

    @case('rectificar')
        <div class="alert alert-danger">Debe rectificar su evidencia y volverla a enviar</div>
        @break

        @case('aceptada')
        <div class="alert alert-success">Su Solicitud de matrícula ha sido aceptada</div>
        @break


        @case('denegada')
        <div class="alert alert-danger">Su solicitud de matrícula ha sido denegada por las siguientes razones:</div>
        @break


    @default
        <div class="alert alert-info">Su solicitud está pendiente a ser revisada</div>
@endswitch

@endif

@endsection

@section('sidebar')


<a href="{{ route('evidencia.showByUser', ['user_id' => auth()->user()->id]) }}"><i class="fa fa-fw fa-home"></i>Mi Evidencia</a>


<br>
<a href="{{ route('evidencia.status', ['user_id' => auth()->user()->id]) }}">Ver estado de la solicitud</a>
@endsection