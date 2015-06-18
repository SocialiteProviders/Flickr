<?php

namespace SocialiteProviders\Flickr;

use Laravel\Socialite\One\AbstractProvider;
use Laravel\Socialite\One\User;

class Provider extends AbstractProvider
{
    /**
     * {@inheritDoc}
     */
    public function user()
    {
        if (!$this->hasNecessaryVerifier()) {
            throw new \InvalidArgumentException('Invalid request. Missing OAuth verifier.');
        }

        $user = $this->server->getUserDetails($token = $this->getToken());

        return (new User())->setRaw($user->extra)->map([
            'id' => $user->id, 'nickname' => $user->nickname,
            'name' => $user->name, 'email' => null, 'avatar' => null,
        ])->setToken($token->getIdentifier(), $token->getSecret());
    }
}
