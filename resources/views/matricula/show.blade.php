@extends('layouts.app')

@section('template_title')
    {{ $matricula->name ?? "{{ __('Show') Matricula" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Matricula</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('matriculas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $matricula->Estado }}
                        </div>
                        <div class="form-group">
                            <strong>Evidencia Id:</strong>
                            {{ $matricula->evidencia_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('sidebar')

<a href="{{ route('evidencias.index')}}"><i class="fa fa-fw fa-home"></i> Evidencias</a>
<a href="{{ route('matriculas.index')}}"><i class="fa fa-fw fa-home"></i> Matriculas</a>
<a href="{{ route('users.index')}}"><i class="fa fa-fw fa-home"></i> Usuarios</a>

@endsection
