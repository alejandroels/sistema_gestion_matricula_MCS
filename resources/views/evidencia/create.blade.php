@extends('layouts.app')

@section('template_title')
    {{ __('Crear') }} Evidencia
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Evidencia</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('evidencias.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('evidencia.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('sidebar')


<a href="{{ route('evidencia.showByUser', ['user_id' => auth()->user()->id]) }}"><i class="fa fa-fw fa-home"></i>Mi Evidencia</a>


<br>
<a href="{{ route('evidencia.status', ['user_id' => auth()->user()->id]) }}">Ver estado de la solicitud</a>
@endsection

