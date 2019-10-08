
{{ $Modo == 'crear' ? 'Agregar Empleado' : 'Modificar Empleado' }} <br>
<div class="form-group">
    <label for="nombre" class="control-label">{{'Nombre'}}</label>
    <input type="text" class="form-control {{ $errors->has('Nombre') ? 'is-invalid' : ''}}" name="Nombre" id="Nombre" value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre') }}">
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="apellidoPaterno" class="control-label">{{'Apellido Paterno'}}</label>
    <input type="text" class="form-control {{ $errors->has('ApellidoPaterno') ? 'is-invalid' : ''}}" name="ApellidoPaterno" id="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno : old('ApellidoPaterno') }}">
    {!! $errors->first('ApellidoPaterno','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="apellidoMaterno" class="control-label">{{'Apellido Materno'}}</label>
    <input type="text" class="form-control {{ $errors->has('ApellidoMaterno') ? 'is-invalid' : ''}}" name="ApellidoMaterno" id="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno : old('ApellidoMaterno') }}">
    {!! $errors->first('ApellidoMaterno','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="correo" class="control-label">{{'Correo'}}</label>
    <input type="email" class="form-control {{ $errors->has('Correo') ? 'is-invalid' : ''}}" name="Correo" id="Correo" value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo') }}">
    {!! $errors->first('Correo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="foto" class="control-label">{{'Foto'}}</label>
    @if (isset($empleado->Foto))
        <br><img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $empleado->Foto }}" alt="" width="100">
    @endif
    <input type="file" class="form-control {{ $errors->has('Foto') ? 'is-invalid' : ''}}" name="Foto" id="Foto" value="">
    {!! $errors->first('Foto','<div class="invalid-feedback">:message</div>') !!}
</div>


<input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Guardar' : 'Actualizar' }}">

<a class="btn btn-primary" href="{{ url('empleados') }}">Regresar</a>
