<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\ResponseTrait;
use App\User;
use Laminas\Diactoros\ServerRequest;
use Laravel\Passport\Http\Controllers\AccessTokenController;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers
 */
class LoginController extends AccessTokenController
{
    use ResponseTrait;

    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $tokenRequest  = (new ServerRequest())->withParsedBody([
                'grant_type'    => config('auth.passport.grant_type', 'password'),
                'client_id'     => config('auth.passport.client_id'),
                'client_secret' => config('auth.passport.client_secret'),
                'username'      => $request->get('username'),
                'password'      => $request->get('password'),
            ]);
            $tokenResponse = $this->issueToken($tokenRequest);
            $token         = $tokenResponse->getContent();

            $user = User::whereEmail($request->get('username'))->first();
        } catch (\Exception $exception) {
            return $this->json('Wrong credentials.', 422);
        }

        return $this->json(['user' => $user, 'token' => json_decode($token, true)]);
    }
}
