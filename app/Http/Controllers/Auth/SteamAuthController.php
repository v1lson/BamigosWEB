<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Ilzrv\LaravelSteamAuth\Exceptions\Authentication\SteamResponseNotValidAuthenticationException;
use Ilzrv\LaravelSteamAuth\Exceptions\Validation\ValidationException;
use Ilzrv\LaravelSteamAuth\SteamAuthenticator;
use Ilzrv\LaravelSteamAuth\SteamUserDto;

final class SteamAuthController
{
    public function __invoke(
        Request $request,
        Redirector $redirector,
        Client $client,
        HttpFactory $httpFactory,
        AuthManager $authManager,
    ): RedirectResponse {
        $steamAuthenticator = new SteamAuthenticator(
            new Uri($request->getUri()),
            $client,
            $httpFactory,
        );

        try {
            $steamAuthenticator->auth();
        } catch (ValidationException|SteamResponseNotValidAuthenticationException) {
            return $redirector->to(
                $steamAuthenticator->buildAuthUrl()
            );
        }

        $steamUser = $steamAuthenticator->getSteamUser();

        $authManager->login(
            $this->firstOrCreate($steamUser),
            true
        );

        return $redirector->to('/');
    }

    private function firstOrCreate(SteamUserDto $steamUser): User
    {
        return User::firstOrCreate([
            'steam_id' => $steamUser->getSteamId(),
        ], [
            'name' => $steamUser->getPersonaName(),
            'avatar' => $steamUser->getAvatarFull(),
            'player_level' => $steamUser->getPlayerLevel(),
            // ...and other what you need
        ]);
    }
}
