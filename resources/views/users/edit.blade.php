@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Editar usuario'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('users.update', $user->id) }}" method="post" class="form-horizontal">
          @csrf
          @method('PUT')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Usuario</h4>
              <p class="card-category">Editar datos</p>
            </div>
            <div class="card-body">

              {{-- nombre user/admin --}}
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" readonly autofocus>
                  @if ($errors->has('name'))
                    <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                  @endif
                </div>
              </div>              
              {{-- end user/admin --}}

              {{-- UserName --}}
              <div class="row">
                <label for="username" class="col-sm-2 col-form-label">Nombre de usuario</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
                  @if ($errors->has('username'))
                    <span class="error text-danger" for="input-username">{{ $errors->first('username') }}</span>
                  @endif
                </div>
              </div>
              {{-- end UserName --}}

              {{-- Nombre --}}

              <div class="row">
                <label for="nombreU" class="col-sm-2 col-form-label">Nombres</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="nombreU" placeholder="Ingrese los nombres" value="{{ old('nombreU', $user->nombreU) }}">
                  @if ($errors->has('nombreU'))
                    <span class="error text-danger" for="input-nombreU">{{ $errors->first('nombreU') }}</span>
                  @endif
                </div>
              </div>

              {{-- end nombre --}}

              {{-- apellidos --}}

              <div class="row">
                <label for="apellidoU" class="col-sm-2 col-form-label">Apellidos</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="apellidoU" placeholder="Ingrese los apellidos" value="{{ old('apellidoU', $user->apellidoU) }}">
                  @if ($errors->has('apellidoU'))
                    <span class="error text-danger" for="input-apellidoU">{{ $errors->first('apellidoU') }}</span>
                  @endif
                </div>
              </div>

              {{-- end apellidos --}}


              {{-- Numero de Documento --}}

              <div class="row">
                <label for="numDocumento" class="col-sm-2 col-form-label">Numero de Documento</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="numDocumento" placeholder="Ingrese los apellidos" value="{{ old('numDocumento', $user->numDocumento) }}"readonly autofocus>
                  @if ($errors->has('numDocumento'))
                    <span class="error text-danger" for="input-numDocumento">{{ $errors->first('numDocumento') }}</span>
                  @endif
                </div>
              </div>

              {{-- end Numero de documento --}}

              {{-- Correo --}}
              <div class="row">
                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-7">
                  <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                  @if ($errors->has('email'))
                    <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>
              {{-- End Correo --}}

              {{-- Contraseña --}}
              <div class="row">
                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control" name="password" placeholder="Ingrese la contraseña sólo en caso de modificarla">
                  @if ($errors->has('password'))
                    <span class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>
              {{-- End Contraseña--}}

              {{-- Roles--}}
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Roles</label>
                <div class="col-sm-7">
                    <div class="form-group">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <table class="table">
                                    <tbody>
                                        @foreach ($roles as $id => $role)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="roles[]"
                                                            value="{{ $id }}" {{ $user->roles->contains($id) ? 'checked' : ''}}
                                                        >
                                                        <span class="form-check-sign">
                                                            <span class="check" value=""></span>
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
            {{-- End Roles--}}

            {{-- Numero de cuenta --}}

            <div class="row">
              <label for="numCuenta" class="col-sm-2 col-form-label">Número de cuenta</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="numCuenta" placeholder="Ingrese el número de cuenta que asignara al usuario" value="{{ old('numCuenta', $user->numCuenta) }}">
                @if ($errors->has('numCuenta'))
                  <span class="error text-danger" for="input-numCuenta">{{ $errors->first('numCuenta') }}</span>
                @endif
              </div>
            </div>

            {{-- end numero de cuenta --}}

            {{-- saldo --}}

            <div class="row">
              <label for="saldo" class="col-sm-2 col-form-label">Saldo</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" name="saldo" placeholder="Ingrese el saldo con el cual creara la cuenta (Opcional)" value="{{ old('saldo', $user->saldo) }}">
                @if ($errors->has('saldo'))
                  <span class="error text-danger" for="input-saldo">{{ $errors->first('saldo') }}</span>
                @endif
              </div>
            </div>

            {{-- end saldo --}}

            </div>
            <!--Footer-->
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Actualizar</button>
              <a href="{{ route('users.index') }}" class="btn btn-success"> Volver </a>
            </div>

            <!--End footer-->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
