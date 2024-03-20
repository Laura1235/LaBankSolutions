@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Nuevo usuario'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('users.store') }}" method="post" class="form-horizontal">
          @csrf
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Usuario</h4>
              <p class="card-category">Ingresar datos</p>
            </div>
            <div class="card-body">

              @if ($errors->has('numDocumento'))
              <span class="error text-danger" for="input-numDocumento">{{ $errors->first('numDocumento') }}</span>
              @endif

              {{-- @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif --}}

              {{-- name --}}
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Rol</label>
                <div class="col-sm-7">
                  <select class="form-control" name="name" autofocus>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                  </select>
                  @if ($errors->has('name'))
                    <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                  @endif
                </div>
              </div>
              {{-- end name --}}

              {{-- username --}}
              <div class="row">
                <label for="username" class="col-sm-2 col-form-label">Nombre de usuario</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="username" placeholder="Ingrese su nombre de usuario" value="{{ old('username') }}">
                  @if ($errors->has('username'))
                    <span class="error text-danger" for="input-username">{{ $errors->first('username') }}</span>
                  @endif
                </div>
              </div>
              {{-- end username --}}

              {{-- nombre --}}

              <div class="row">
                <label for="nombreU" class="col-sm-2 col-form-label">Nombres</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="nombreU" placeholder="Ingrese sus nombres" value="{{ old('nombreU') }}">
                  @if ($errors->has('nombreU'))
                    <span class="error text-danger" for="input-nombreU">{{ $errors->first('nombreU') }}</span>
                  @endif
                </div>
              </div>

              {{-- end nombre --}}

              {{-- apellido --}}

              <div class="row">
                <label for="apellidoU" class="col-sm-2 col-form-label">Apellidos</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="apellidoU" placeholder="Ingrese sus apellidos" value="{{ old('apellidoU') }}">
                  @if ($errors->has('apellidoU'))
                    <span class="error text-danger" for="input-apellidoU">{{ $errors->first('apellidoU') }}</span>
                  @endif
                </div>
              </div>

              {{-- end apellidos --}}

              {{-- tipo de documento --}}

              <div class="row">
                <label for="tipoDocumento" class="col-sm-2 col-form-label">Tipo de Documento</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="tipoDocumento" value="Cédula de Ciudadanía" readonly>
                  @if ($errors->has('tipoDocumento'))
                    <span class="error text-danger" for="input-tipoDocumento">{{ $errors->first('tipoDocumento') }}</span>
                  @endif
                </div>
              </div>              

              {{-- end tipo de documento --}}

              {{-- numero de documento --}}

              <div class="row">
                <label for="numDocumento" class="col-sm-2 col-form-label">Número de Documento</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="numDocumento" placeholder="Ingrese el numero de Documento" value="{{ old('numDocumento') }}">
                  @if ($errors->has('numDocumento'))
                <div id="numDocumento-error" class="error text-danger pl-3" for="numDocumento" style="display: block;">
                    <strong>{{ $errors->first('numDocumento') }}</strong>
                </div>
                @endif
                </div>
              </div>

              {{-- end numero de documento --}}

              <div class="row">
                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-7">
                  <input type="email" class="form-control" name="email" placeholder="Ingrese su correo" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                    <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control" name="password" placeholder="Contraseña">
                  @if ($errors->has('password'))
                    <span class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>
              <div class="row">
                <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                <div class="col-sm-7">
                    <div class="form-group">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <table class="table">
                                    <tbody>
                                        @foreach ($roles as $id => $role)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="roles[]"
                                                            value="{{ $id }}"
                                                        >
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $role }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!--Footer-->
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <!--End footer-->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
