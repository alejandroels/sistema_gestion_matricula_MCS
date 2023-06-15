@extends('layouts.app')

@section('template_title')
    Evidencia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Evidencias') }}
                            </span>
                            <div>

                            <form action="{{ route('evidencia.search') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Buscar..." required>
                                  
                                    <div class="input-group-append">
                                        
                                        <button class="btn btn-primary" type="submit">
                                            Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>

                            </div>
                             <!-- <div class="float-right">
                                <a href="{{ route('evidencias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div> -->
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
										<th>Año graduado</th>
										<th>Dirección</th>
										<th>Área de trabajo</th>
									
										<th>Edición maestría</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evidencias as $evidencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $evidencia->user->name }}</td>                                       
											<td>{{ $evidencia->Nombre }}</td>
											<td>{{ $evidencia->Apellido }}</td>
											<td>{{ $evidencia->AnnoGraduado }}</td>
											<td>{{ $evidencia->Direccion }}</td>
											<td>{{ $evidencia->AreaTrabajo }}</td>

											<td>{{ $evidencia->EdicionMaestria }}</td>

                                            <td>
                                       
                                            
                                                <a href="{{ route('evidencia.accept',$evidencia->id) }}" class="btn btn-sm btn-success">{{ __('Confirmar') }}</a>
                                                <a href="{{ route('evidencia.rectific',$evidencia->id) }}" class="btn btn-sm btn-danger">{{ __('Corregir Errores') }}</a>
                                                <a class="btn btn-sm btn-primary " href="{{ route('evidencias.show',$evidencia->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Visualizar Evidencia') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $evidencias->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('sidebar')

<a href="{{ route('evidencias.index')}}"><i class="fa fa-fw fa-home"></i> Evidencias</a>
<a href="{{ route('matriculas.index')}}"><i class="fa fa-fw fa-home"></i> Matriculas</a>
<a href="{{ route('users.index')}}"><i class="fa fa-fw fa-home"></i> Usuarios</a>

@endsection
