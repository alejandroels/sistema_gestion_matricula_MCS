@extends('layouts.app')

@section('title', 'Admin')

@section('sidebar')

<a href="{{ route('evidencias.index')}}"><i class="fa fa-fw fa-home"></i> Evidencias</a>
<a href="{{ route('matriculas.index')}}"><i class="fa fa-fw fa-home"></i> Matriculas</a>
<a href="{{ route('users.index')}}"><i class="fa fa-fw fa-home"></i> Usuarios</a>
@endsection


@section('content')


@endsection

