@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Detalles del usuario'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="card-title">Usuarios</div>
            <p class="card-category">Vista detallada del usuario {{ $user->name }}</p>
          </div>
          <!--body-->
          <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="success">
              {{ session('success') }}
            </div>
            @endif
            <div class="row">
              <!--Start third-->
              <div class="col-md-4">
                <div class="card card-user">
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <tbody>
                        {{-- <tr>
                          <th>ID</th>
                          <td>{{ $user->id }}
                          </td>
                        </tr> --}}
                        <tr>
                          <th>Nombres</th>
                          <td>{{ $user->nombreU }}</td>
                        </tr>
                        <tr>
                          <th>Apellidos</th>
                          <td>{{ $user->apellidoU }}</td>
                        </tr>
                        <tr>
                          <th>Correo Electronico</th>
                          <td><span class="badge badge-primary">{{ $user->email }}</span></td>
                        </tr>
                        <tr>
                          <th>Número de Documento</th>
                          <td>{!! $user->numDocumento !!}</td>
                        </tr>
                        <tr>
                          <th>Fecha de Creacion</th>
                          <td><a href="#" target="_blank">{{  $user->created_at  }}</a></td>
                        </tr>
                        <tr>
                          <th>Número de Cuenta</th>
                          <td>{{ $user->numCuenta }}</td>
                        </tr>
                        <tr>
                          <th>Saldo</th>
                          <td>{{ $user->saldo }}</td>
                        </tr>
                        <tr>
                          <th>Roles</th>
                          <td>
                              @forelse ($user->roles as $role)
                                  <span class="badge rounded-pill bg-dark text-white">{{ $role->name }}</span>
                              @empty
                                  <span class="badge badge-danger bg-danger">No roles</span>
                              @endforelse
                          </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    <div class="button-container">
                      <a href="{{ route('users.index') }}" class="btn btn-sm btn-success mr-3"> Volver </a>
                      {{-- <a href="#" class="btn btn-sm btn-twitter"> Editar </a> --}}
                    </div>
                  </div>
                </div>
              </div>
              <!--end third-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
