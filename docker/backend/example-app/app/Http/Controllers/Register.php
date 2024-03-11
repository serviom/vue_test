<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Psy\debug;


class Register extends Controller
{

    public function register() {
        return view('register');
    }

    public function registerPost(Request $request) {

        $data = $request->post();

        if (!$this->validator($data)->validate()) {
            return;
        }

        DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
            ]);

            Phone::create([
                'user_id' => $user->id,
                'phone' => $data['phone']
            ]);

            $country = Countries::query()->firstOrCreate([
                'name' => $data['country']['name'],
                'code' => $data['country']['code'],
                'flag' => $data['country']['flag'],
                'prefix' => $data['country']['dial_code']
            ]);

            $user->country()->associate($country);
            $user->save();

        });
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name'         => ['required', 'string', 'max:100'],
                'phone'        => ['required', 'phoneValidate'],
                'country'      => ['required', 'array', 'min:4'],
                'email'        => [
                    'email:rfc,dns',
                    'required',
                    'string',
                    'email',
                    'max:150',
                    'unique:users,email',
                ],
            ]
        );
    }
}
