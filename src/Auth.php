<?php 

namespace buibr\KambiMrGreen;

use buibr\KambiMrGreen\Exceptions\InvalidConfigException;

class Auth {


    /**
     *  Server accpeted connection
     */
    private $scheme = 'https';

    /**
     *  Server endpoint
     */
    private $server = 'cts-api.kambi.com';

    /**
     *  Version of the api.
     */
    private $version = 'v2018';

    /**
     *  The username from the account.
     */
    private $offering = 'kambi';


    /**
     * Treat this API as string
     */
    public function __toString()
    {
        return $this->scheme . '://' . $this->server . '/offering/' . $this->version . '/' . $this->offering .'/';
    }


    /**
     * 
     */
    public function __set($name, $value)
    {
        if(property_exists($this, $name)){
            return $this->$name = $value;
        }
    }

    /**
     * 
     */
    public function __get($name)
    {
        if(!\property_exists($this, $name)){
            return null;
        }

        return $this->$name;
    }

}