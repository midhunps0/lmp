<?php
namespace App\Scopes;
use App\Models\Source;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
trait createClientAdmin{

/* Creating a client admin each time a new client is created */

public function createClientAdmin($clientId,$validatedData){
    $user = User::create([
        'name' => $validatedData['name'],
        'email' =>  $validatedData['email'],
        'phone' =>  $validatedData['phone'],
        'password' => bcrypt( $validatedData['password']),
        'client_id'=>$clientId,
    ]);
    $user->assignRole('Client Admin');
    return $user;
}
}