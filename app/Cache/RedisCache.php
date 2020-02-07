<?php


namespace App\Cache;


use App\Cache\Contracts\CacheInterface;
use Predis\Client as Predis;

class RedisCache implements CacheInterface
{
    /**
     * @var Predis
     */
    private $client;
    
    public function __construct(Predis $client)
    {
        $this->client = $client;
    }
    
    public function get($key)
    {
        return $this->client->get($key);
    }
    
    public function put($key, $value, $minutes = null)
    {
        if ($minutes === null) {
            $this->client->set($key, $value);
            
            return;
        }
        
        $this->client->setex($key, (int) max(1, $minutes * 60), $value);
    }
    
    public function remember($key, $minutes = null, callable $callback)
    {
        if (($value = $this->get($key)) !== null) {
            return $value;
        }
        
        $this->put($key, $value = $callback(), $minutes);
        
        return $value;
    }
}