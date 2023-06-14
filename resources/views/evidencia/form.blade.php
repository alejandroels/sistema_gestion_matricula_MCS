<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre', 'Nombre') }}
            {{ Form::text('Nombre', $evidencia['Nombre'] ?? '', ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Apellido', 'Apellido') }}
            {{ Form::text('Apellido', $evidencia['Apellido'] ?? '', ['class' => 'form-control' . ($errors->has('Apellido') ? ' is-invalid' : ''), 'placeholder' => 'Apellido']) }}
            {!! $errors->first('Apellido', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('AnnoGraduado', 'Año de Graduación') }}
            {{ Form::text('AnnoGraduado', $evidencia['AnnoGraduado'] ?? '', ['class' => 'form-control' . ($errors->has('AnnoGraduado') ? ' is-invalid' : ''), 'placeholder' => 'Año de Graduación']) }}
            {!! $errors->first('AnnoGraduado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Direccion', 'Dirección') }}
            {{ Form::text('Direccion', $evidencia['Direccion'] ?? '', ['class' => 'form-control' . ($errors->has('Direccion') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
            {!! $errors->first('Direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('AreaTrabajo', 'Área de Trabajo') }}
            {{ Form::text('AreaTrabajo', $evidencia['AreaTrabajo'] ?? '', ['class' => 'form-control' . ($errors->has('AreaTrabajo') ? ' is-invalid' : ''), 'placeholder' => 'Área de Trabajo']) }}
            {!! $errors->first('AreaTrabajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('FotocopiaTitulo', 'Fotocopia del Título') }}
            {{ Form::file('FotocopiaTitulo', ['class' => 'form-control' . ($errors->has('FotocopiaTitulo') ? ' is-invalid' : ''), 'placeholder' => 'Fotocopia del Título']) }}
            {!! $errors->first('FotocopiaTitulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('ActaSolicitud', 'Acta de Solicitud') }}
            {{ Form::file('ActaSolicitud', ['class' => 'form-control' . ($errors->has('ActaSolicitud') ? ' is-invalid' : ''), 'placeholder' => 'Acta de Solicitud']) }}
            {!! $errors->first('ActaSolicitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('EdicionMaestria', 'Edición de Maestría') }}
            {{ Form::text('EdicionMaestria', $evidencia['EdicionMaestria'] ?? '', ['class' => 'form-control' . ($errors->has('EdicionMaestria') ? ' is-invalid' : ''), 'placeholder' => 'Edición de Maestría']) }}
            {!! $errors->first('EdicionMaestria', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <br>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
