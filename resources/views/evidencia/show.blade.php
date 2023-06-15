@extends('layouts.app')

@section('template_title')
    {{ $evidencia->name ?? "{{ __('') Evidencia" }}
@endsection

@section('content')

@if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('') }} Evidencia</span>
                        </div>
    
                        @if(auth()->user()->role == 'admin')

                        <!-- <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('evidencias.index') }}"> {{ __('Back') }}</a>
                        </div> -->
                    </div>

                    @endif
                    <br>
                    @if($evidencia)
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $evidencia->Nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $evidencia->Apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Año graduado:</strong>
                            {{ $evidencia->AnnoGraduado }}
                        </div>
                        <div class="form-group">
                            <strong>Dirección:</strong>
                            {{ $evidencia->Direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Área de trabajo:</strong>
                            {{ $evidencia->AreaTrabajo }}
                        </div>
                        <div class="form-group">
                            <strong>Fotocopia del título:</strong>
                            <img src="{{asset('storage'.'/'. $evidencia->FotocopiaTitulo)}}" alt="" class="img-fluid" width="100px">
                        </div>
                        <div class="form-group">
                            <strong>Acta de solicitud:</strong>
                            <img src="{{asset('storage'.'/'. $evidencia->ActaSolicitud)}}" alt="" class="img-fluid" width="100px">
                        <div class="form-group">
                            <strong>Edición de la maestría:</strong>
                            {{ $evidencia->EdicionMaestria }}
                        </div>
                        <br><br>

@if(auth()->user()->role == 'user')

     <form action="{{ route('evidencia.destroy', ['user_id' => auth()->user()->id]) }}"  method="POST">
    @csrf
    @method('DELETE')
    <a class="btn btn-sm btn-success" href="{{ route('evidencia.edit', ['user_id' => auth()->user()->id]) }}">
    <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
</a>

    <button type="submit" onclick="return confirm('¿Estas seguro que desea eliminar su evidencia?')" class="btn btn-sm btn-danger">
        <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar mi Evidenica') }}
    </button>
</form>
@endif
                    </div>
                    @else
    <p>Evidencia no registrada</p>

    <br>

            <div class="float-left">
            <a href="{{ route('evidencias.create') }}" class="btn btn-primary btn-sm float-left"  data-placement="left">
              {{ __('Registrar Evidencia') }}
            </a>
            </div>
            <br>
@endif
                </div>
                
            </div>
            
        </div>




    </section>
@endsection
@section('sidebar')

@if(auth()->user()->role == 'admin')
<a href="{{ route('evidencias.index')}}"><i class="fa fa-fw fa-home"></i> Evidencias</a>
<a href="{{ route('matriculas.index')}}"><i class="fa fa-fw fa-home"></i> Matrículas</a>
<a href="{{ route('users.index')}}"><i class="fa fa-fw fa-home"></i> Usuarios</a>
@elseif (auth()->user()->role == 'user')

<a href="{{ route('evidencia.showByUser', ['user_id' => auth()->user()->id]) }}"><i class="fa fa-fw fa-home"></i>Mi Evidencia</a>


<br>
<a href="{{ route('evidencia.status', ['user_id' => auth()->user()->id]) }}">Ver estado de la solicitud</a>

@endif    
@endsection

