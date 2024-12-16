<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\User;

class AuthService
{

    /*
    ***************************
      AUTH METHODS
    ***************************
    */

    public function fetchAllUsers()
    {
        try {

            return User::all();

        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function registerAccount($userInformation)
    {

        $message = '';

        try {

            // Check if email exists
            if (!User::where('email', $userInformation['email'])->first()) {
                // Create user
                $user = User::create([
                    'firstName' => $userInformation['firstName'],
                    'lastName' => $userInformation['lastName'],
                    'email' => $userInformation['email'],
                    'pinCode' => $userInformation['pinCode'],
                ]);

                // Assuming na nag open na ng account si user
                // Create the account associated with the last created user ID
                Accounts::create([
                    'userID' => $user->id,
                    'accountBalance' => 0,
                    'accountStatut' => 'open'
                ]);

                $message = 'User Created!';
            }else {
                $message = "Email Used!";
            }

            return $message;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function loginAccount($pinCode)
    {
        $message = '';

        try {

            $userData = User::where('pinCode', $pinCode)->first();

            if(!$userData) {
                $message = "Invalid Pin Code!";
            }else {
                $message = $userData;
            }

            return $message;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
