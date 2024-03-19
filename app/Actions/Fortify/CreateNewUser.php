<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class),],
            'tipoDocumento' => ['required', 'string', 'max:255'],
            'numDocumento' => ['required', 'string', Rule::unique(User::class),],
            'nombreU' => ['required', 'string', 'max:255'],
            'apellidoU' => ['required', 'string', 'max:255'],
            'numCuenta' => ['nullable', 'integer', 'max:11'],
            'saldo' => ['nullable', 'decimal', 'max:11'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'tipoDocumento' => $input['tipoDocumento'],
            'numDocumento' => $input['numDocumento'],
            'nombreU' => $input['nombreU'],
            'apellidoU' => $input['apellidoU'],
            'numCuenta' => $input['apellidoU'],
            'saldo' => $input['numCuenta'],
            'email' => $input['saldo'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('User');
        return $user;
    }
}
