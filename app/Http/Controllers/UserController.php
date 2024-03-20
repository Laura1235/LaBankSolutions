<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_index'), 403);
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);
        $roles = Role::all()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
        $request->validate([
            // 'name' => 'required|min:3|max:5',
            // 'username' => 'required',
            // 'email' => 'required|email|unique:users',
            // 'password' => 'required'
        ]);
        $user = User::create($request->only('name', 'username','nombreU', 'apellidoU', 'tipoDocumento', 'numDocumento', 'status', 'email')
            + [
                'password' => bcrypt($request->input('password')),
            ]);

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario creado correctamente');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), 403);
        // $user = User::findOrFail($id);
        // dd($user);
        $user->load('roles');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        // $user=User::findOrFail($id);
        $data = $request->only('name', 'username','nombreU', 'apellidoU', 'tipoDocumento', 'numDocumento', 'numCuenta', 'saldo', 'email');
        $password=$request->input('password');
        if($password){
            $data['password'] = bcrypt($password);
        }
        
        if (auth()->user()->isAdmin) { 
        $user->status = $request->has('status') ? 1 : 0;
        }

        $user->save();
        $user->update($data);

        if ($request->filled('roles')) {
            $roles = $request->input('roles', []);
            $user->syncRoles($roles);
        }

        // Operacion Bancaria
        $operationType = $request->input('operation_type');
        $operationAmount = $request->input('operation_amount');

        if ($operationType && $operationAmount) {
        if ($operationType == 'add') {
            $user->saldo += $operationAmount;
        } elseif ($operationType == 'subtract') {
            $user->saldo -= $operationAmount;
        }

        $user->save(); 

    }
        // fin de operacion bancaria

        // if (auth()->user()->hasAny) { 
        //     return redirect()->route('users.show', $user->id)->with('success', 'Actualizacion Correcta');
        // } else {
        //     return redirect()->route('posts.index', $user->id)->with('success', 'Su saldo fue actualizado');
        // }
        
        return redirect()->route('posts.index', $user->id)->with('success', 'Actualizacion Correcta');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_destroy'), 403);

        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index');
        }

        $user->delete();
        return back()->with('succes', 'Usuario eliminado correctamente');
    }

    public function generatePDF()
    {
        $users = User::all();
        $pdf = Pdf::loadview('users.report', compact('users'));
        return $pdf->download('reporte_usuarios.pdf');
    }
}
