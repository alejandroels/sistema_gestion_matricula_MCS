@extends('layouts.app')

@section('title', 'Home')

@section('content')
@if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
@endsection

@section('sidebar')


<a href="{{ route('evidencia.showByUser', ['user_id' => auth()->user()->id]) }}"><i class="fa fa-fw fa-home"></i>Mi Evidencia</a>


<br>
<a href="{{ route('evidencia.status', ['user_id' => auth()->user()->id]) }}">Ver estado de la solicitud</a>
@endsection


