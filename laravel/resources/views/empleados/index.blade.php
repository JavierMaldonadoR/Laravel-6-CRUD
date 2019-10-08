@extends('layouts.app')

@section('content')

<div class="container">

    @if (Session::has('Mensaje'))
        <div class="alert alert-success" role="alert">
            {{Session::get('Mensaje')}}
        </div>
    @endif

    <a href="{{ url('empleados/create') }}" class="btn btn-success">Agregar Empleado</a> <br> <br>

    <table class="table table-dark table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">
                        <img src="{{ asset('storage') . '/' . $empleado->Foto }}" class="img-thumbnail img-fluid" alt="" width="100">
                    </td>
                    <td class="align-middle">{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }} {{ $empleado->ApellidoMaterno }}</td>
                    <td class="align-middle">{{ $empleado->Correo }}</td>
                    <td class="align-middle">
                        <a class="btn btn-warning" href="{{ url('/empleados/'.$empleado->id.'/edit') }}">Editar</a>
                        <form method="post" action="{{ url('/empleados/'.$empleado->id) }}" style="display:inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $empleados->links() }}


</div>

@endsection

