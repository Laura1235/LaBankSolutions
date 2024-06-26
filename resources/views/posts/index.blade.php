@extends('layouts.main', ['activePage' => 'posts', 'titlePage' => 'Cuenta de usuario'])

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title ">Información del Usuario</h4>
                    <p class="card-category"> Detalle del usuario actual</p>
                  </div>
                  <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="success">
                      {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="text-primary">
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Documento</th>
                          <th>Roles</th>
                          <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                          @php
                          $user = Auth::user();
                          @endphp

                          <tr>
                            <td>{{ $user->nombreU }}</td>
                            <td>{{ $user->apellidoU }}</td>
                            <td>{{ $user->numDocumento }}</td>
                            <td>
                                @forelse ($user->roles as $role)
                                  <span class="badge badge-info">{{ $role->name }}</span>
                                @empty
                                  <span class="badge badge-danger">No roles</span>
                                @endforelse
                              </td>

                            {{-- Acciones --}}
                            <td class="td-actions text-right">
                              @can('user_show')
                              <a href="{{ route('users.show', $user->id) }}" class="btn btn-info"><i class="material-icons">person</i></a>
                              @endcan
                              @can('user_edit')
                              <a href="{{ route('posts.edit', $user->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                              @endcan
                              @can('user_destroy')
                              <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Seguro?')">
                              @csrf
                              @method('DELETE')
                                  <button class="btn btn-danger" type="submit" rel="tooltip">
                                  <i class="material-icons">close</i>
                                  </button>
                              </form>
                              @endcan
                            </td>
                            {{-- End acciones --}}
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
