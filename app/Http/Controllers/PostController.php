<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('post_index'), 403);

        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('post_create'), 403);

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), 403);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        // Aquí asumimos que tienes un modelo User
        $user = User::findOrFail($userId);
        // Asegúrate de que la vista 'edit.blade.php' exista en la ubicación adecuada dentro de la carpeta 'resources/views'
        return view('posts.edit', compact('user'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Post $post)
    // {
    //     $post->update($request->all());

    //     return redirect()->route('posts.index');
    // }

    public function update(UserEditRequest $request, User $user)
{
    $data = $request->only('name', 'username', 'nombreU', 'apellidoU', 'tipoDocumento', 'numDocumento', 'numCuenta', 'saldo', 'email');
    $password = $request->input('password');
    if ($password) {
        $data['password'] = bcrypt($password);
    }

    // $user->save();
    $user->update($data);
    
    // Operacion Bancaria
    $operationType = $request->input('operation_type');
    $operationAmount = $request->input('operation_amount');

    if ($operationType && $operationAmount) {
        if ($operationType == 'add') {
            $user->saldo += $operationAmount;
        } elseif ($operationType == 'subtract') {
            // Verifica si la operación deja el saldo en negativo
            if ($user->saldo - $operationAmount < 0) {
                // Aquí puedes optar por devolver un mensaje de error sin actualizar el saldo
                return redirect()->back()->with('error', 'La operación no se puede completar porque deja el saldo en negativo.');
            } else {
                $user->saldo -= $operationAmount;
            }
        }

        $user->save();
    }
    // fin de operacion bancaria

    return redirect()->route('posts.index', $user->id)->with('success', 'Operación exitosa');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), 403);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
