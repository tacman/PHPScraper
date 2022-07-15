<?php

// Namespace
namespace spekulatius;

// Libs used.
// https://github.com/FriendsOfPHP/Goutte
use Goutte\Client;

// https://github.com/jeremykendall/php-domain-parser
use Pdp\Cache;
use Pdp\CurlHttpClient;
use Pdp\Manager;

// https://github.com/Donatello-za/rake-php-plus
use DonatelloZa\RakePlus\RakePlus;
use Pdp\Rules;
use Pdp\Storage\PsrStorageFactory;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class phpscraper
{
    /**
     * Holds the client
     *
     * @var spekulatius\Core;
     */
    protected ?Core $core = null;

    /**
     * Constructor
     */
    public function __construct(private CacheInterface $cache)
    {
        $this->core = new Core();
    }

    /**
     * Catch alls to properties and process them accordingly.
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        // We are assuming that all calls for properties actually method calls...
        return $this->call($name);
    }

    /**
     * Catches the method calls and tries to satisfy them.
     *
     * @param string $name
     * @param array $arguments = null
     * @return mixed
     */
    public function __call(string $name, array $arguments = null)
    {
        if ($name == 'call') {
            $name = $arguments[0];
            return $this->core->$name();
        } else {
            return $this->core->$name(...$arguments);
        }
    }
}

