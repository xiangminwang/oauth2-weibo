<?php

namespace XiangminWang\OAuth2\Client\Provider;

use League\OAuth2\Client\Entity\User;
use League\OAuth2\Client\Token\AccessToken;

class Weibo extends \League\OAuth2\Client\Provider\AbstractProvider
{
    public $responseType = 'json';
    public $domain = 'https://api.weibo.com/oauth2';
    public $apiDomain = 'https://api.weibo.com/2';
    public $site = 'http://weibo.com/';

    public function urlAuthorize()
    {
        return $this->domain.'/authorize';
    }

    public function urlAccessToken()
    {
        return $this->domain.'/access_token';
    }

    public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return $this->apiDomain.'/users/show.json?access_token='.$token->accessToken.'&uid='.$token->uid;
    }

    public function userDetails($response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        $user = new User;

        $user->uid = $response->id;
        $user->nickname = isset($response->name) ? $response->name : $response->domain;
        $user->name = isset($response->screen_name) ? $response->screen_name : null;
        $user->location = isset($response->location) ? $response->location : null;
        $user->imageUrl = isset($response->avatar_large) ? $response->avatar_large : null;
        $user->description = isset($response->description) ? $response->description : null;
        $user->urls = [
            'profile' => $site . (isset($response->profile_url) ? $response->profile_url : $response->id),
            'site' => isset($response->url) && $response->url ? $response->url : null,
        ];

        return $user;
    }

    public function userUid($response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        return $response->id;
    }
}