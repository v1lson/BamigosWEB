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
use Ilzrv\LaravelSteamAuth\Exceptions\Authentication\AuthenticationException;
use Ilzrv\LaravelSteamAuth\Exceptions\Authentication\SteamResponseNotValidAuthenticationException;
use Ilzrv\LaravelSteamAuth\Exceptions\Validation\ValidationException;
use Ilzrv\LaravelSteamAuth\SteamAuthenticator;
use Ilzrv\LaravelSteamAuth\SteamUserDto;
use Psr\Http\Client\ClientExceptionInterface;

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
        } catch (AuthenticationException|\JsonException|ClientExceptionInterface $e) {
        }

        $steamUser = $steamAuthenticator->getSteamUser();

        $user = $this->firstOrCreate($steamUser);

        // Actualizar nombre y avatar del usuario
        $user->name = $steamUser->getPersonaName();
        $user->avatar = $steamUser->getAvatarFull();
        $user->save();

        $authManager->login($user, true);

        return $redirector->to('/');
    }

    private function firstOrCreate(SteamUserDto $steamUser): User
    {
        $toSteamID = intval(($steamUser->getSteamId()- 76561197960265728) / 2);
        $transform = "STEAM_1:1:".(String)$toSteamID;
        return User::firstOrCreate([
            'steam_id' => $steamUser->getSteamId(),
        ], [
            'name' => $steamUser->getPersonaName(),
            'avatar' => $steamUser->getAvatarFull(),
            'player_level' => $steamUser->getPlayerLevel(),
            'steamStat' => $transform
            // ...and other what you need
        ]);
    }
}
