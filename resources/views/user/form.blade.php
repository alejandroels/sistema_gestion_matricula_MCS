<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="form-group">
        <label for="name">Usuario</label>
        <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name) }}" placeholder="Ingrese usuario" required>
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    <br>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email) }}" placeholder="Ingrese su correo electrónico" required>
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <br>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Ingrese contraseña" required>
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>
    <br>
    <div class="form-group">
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirme contraseña" required>
    </div>
        
    <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>