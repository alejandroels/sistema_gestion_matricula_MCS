@extends('layouts.app')

@section('template_title')
    Matricula
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Matricula') }}
                            </span>

                             <!-- <div class="float-right">
                                <a href="{{ route('matriculas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Estado</th>
                                        <th>No. Registro</th>
										<th>Area de Trabajo</th>
										<th>Fecha Inicio</th>
										<th>Fecha Fin</th>

										<!-- <th>Evidencia Id</th> -->

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $matricula)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
       
                                            <td>{{ $matricula->evidencia->user->name }}</td>
                                            <td>{{ $matricula->evidencia->Nombre }}</td>
                                            <td>{{ $matricula->evidencia->Apellido }}</td>
											<td>{{ $matricula->Estado }}</td>
											<td>{{ $matricula->NoRegistro }}</td>
											<td>{{ $matricula->AreaTrabajo }}</td>
											<td>{{ $matricula->FechaInicio }}</td>
											<td>{{ $matricula->FechaFin }}</td>

                                            <!-- <td>{{ $matricula->evidencia_id }}</td> -->

                                            <td>
                                                <form action="{{ route('matriculas.destroy',$matricula->id) }}" method="POST" class="d-inline-block">
                                                    <!-- <a class="btn btn-sm btn-primary " href="{{ route('matriculas.show',$matricula->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar Datos') }}</a> -->
                                                    <a class="btn btn-sm btn-success" href="{{ route('matriculas.edit',$matricula->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modificar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Estas seguro que desea eliminar estos datos?')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                                <form action="{{ route('matriculas.darBaja', $matricula->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger">Dar de Baja</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $matriculas->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('sidebar')

<a href="{{ route('evidencias.index')}}"><i class="fa fa-fw fa-home"></i> Evidencias</a>
<a href="{{ route('matriculas.index')}}"><i class="fa fa-fw fa-home"></i> Matriculas</a>
<a href="{{ route('users.index')}}"><i class="fa fa-fw fa-home"></i> Usuarios</a>

@endsection
