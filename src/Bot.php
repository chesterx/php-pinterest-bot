<?php

namespace seregazhuk\PinterestBot;

use seregazhuk\PinterestBot\Api\Providers\Boards;
use seregazhuk\PinterestBot\Api\Providers\Conversations;
use seregazhuk\PinterestBot\Api\Providers\Interests;
use seregazhuk\PinterestBot\Api\Providers\Keywords;
use seregazhuk\PinterestBot\Api\Providers\News;
use seregazhuk\PinterestBot\Api\Providers\Pinners;
use seregazhuk\PinterestBot\Api\Providers\Pins;
use seregazhuk\PinterestBot\Api\Providers\Provider;
use seregazhuk\PinterestBot\Api\Providers\User;
use seregazhuk\PinterestBot\Contracts\ProvidersContainerInterface;

/**
 * Class Bot.
 *
 *
 * @property Pins $pins 
 * @property News $news
 * @property User $user
 * @property Boards $boards
 * @property Pinners $pinners
 * @property Keywords $keywords
 * @property Interests $interests
 * @property Conversations $conversations
 */
class Bot
{
    /**
     * @var ProvidersContainerInterface
     */
    private $providersContainer;

    /**
     * @param ProvidersContainerInterface $providersContainer
     */
    public function __construct(ProvidersContainerInterface $providersContainer)
    {
        $this->providersContainer = $providersContainer;
    }

    /**
     * Proxy method to pinners login.
     *
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function login($username, $password)
    {
        return $this->pinners->login($username, $password);
    }

    /**
     * Proxy method to pinners logout.
     */
    public function logout()
    {
        return $this->pinners->logout();
    }


    /**
     * Magic method to access different providers.
     *
     * @param string $provider
     *
     * @return Provider
     */
    public function __get($provider)
    {
        return $this->providersContainer->getProvider($provider);
    }

    /**
     * Proxy method to Request object.
     *
     * @return array
     */
    public function getLastError()
    {
        return $this->providersContainer->getResponse()->getLastError();
    }

    public function isLoggedIn()
    {
        return $this->providersContainer->getRequest()->isLoggedIn();
    }
}
