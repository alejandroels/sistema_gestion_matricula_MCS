<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('No. Registro') }}
            {{ Form::text('NoRegistro', $matricula->NoRegistro, ['class' => 'form-control' . ($errors->has('NoRegistro') ? ' is-invalid' : ''), 'placeholder' => 'No. Registro']) }}
            {!! $errors->first('NoRegistro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Areade de Trabajo') }}
            {{ Form::text('AreaTrabajo', $matricula->AreaTrabajo, ['class' => 'form-control' . ($errors->has('AreaTrabajo') ? ' is-invalid' : ''), 'placeholder' => 'AreaTrabajo']) }}
            {!! $errors->first('AreaTrabajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha de Inicio') }}
            {{ Form::text('FechaInicio', $matricula->FechaInicio, ['class' => 'form-control' . ($errors->has('FechaInicio') ? ' is-invalid' : ''), 'placeholder' => 'FechaInicio']) }}
            {!! $errors->first('FechaInicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha Fin') }}
            {{ Form::text('FechaFin', $matricula->FechaFin, ['class' => 'form-control' . ($errors->has('FechaFin') ? ' is-invalid' : ''), 'placeholder' => 'FechaFin']) }}
            {!! $errors->first('FechaFin', '<div class="invalid-feedback">:message</div>') !!}
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Modificar') }}</button>
    </div>
</div>