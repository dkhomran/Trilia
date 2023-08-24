<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callbackGoogle()
    {
        try
        {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where("google_id", $googleUser->getId())->first();

            // Vérifiez si un utilisateur avec le même email existe déjà
            $existingUser = User::where("email", $googleUser->getEmail())->first();

            if (!$user)
            {
                if ($existingUser)
                {
                    // Si l'utilisateur existe déjà avec le même e-mail, connectez-le
                    Auth::login($existingUser);
                }
                else
                {
                    // Sinon, créez un nouveau compte
                    $newUser = User::create([
                        'name'  => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId()
                    ]);
                    Auth::login($newUser);
                }
            }
            else
            {
                Auth::login($user);
            }
            return redirect()->route('home');
        }
        catch (\Throwable $th)
        {


            dd("something wrong");
        }
    }
}
