<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Usuarios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Reporte de Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo Electronico</th>
                <th>Número de Documento</th>
                <th>Número de Cuenta</th>
                <th>Username</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->nombreU }}</td>
                <td>{{ $user->apellidoU }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->numDocumento }}</td>
                <td>{{ $user->numCuenta }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
