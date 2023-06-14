@extends('layouts.app')

@section('template_title')
    {{ __('Crear') }} Matricula
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Matricula</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('matriculas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('matricula.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')

<a href="{{ route('evidencias.index')}}"><i class="fa fa-fw fa-home"></i> Evidencias</a>
<a href="{{ route('matriculas.index')}}"><i class="fa fa-fw fa-home"></i> Matriculas</a>

@endsection
