<?php 

namespace buibr\KambiMrGreen;

use GuzzleHttp\Client;
use buibr\KambiMrGreen\Auth;
use buibr\KambiMrGreen\Exceptions\InvalidConfigException;
use buibr\KambiMrGreen\Exceptions\InvalidResponseException;

class Data {

    /**
     *  API for authentication to Kambi.
     */
    protected $api;

    /**
     *  Path of the sector 
     */
    protected $path;

    /**
     * Guzzle client
     */
    protected $client;

    /**
     * Results of the request
     */
    protected $result;

    public function __construct(Auth $api = null, string $path = null)
    {

        if(!empty($path)):
            $this->path = $path;
        endif;

        if(!empty($api)):
            $this->api = $api;
        endif;

        $this->client = new Client();

        return $this;
    }

    /**
     * 
     */
    public function setPath( string $path ){
        $this->path = $path;
    }

    /**
     * 
     */
    public function setApi( Auth $api){
        $this->api = $api;
    }

    /**
     * 
     */
    public function getData(){

        if(empty($this->api) || empty($this->path)):
            throw new InvalidConfigException('Invalid configuration API or Path', 101);
        endif;

        try
        {
            $this->result = $this->client->request('GET', $this->api . $this->path,[
                'headers' => [
                    'Accept' => 'application/json',
                    'Author' => 'buibr',
                ]
            ]);

            
        }
        catch( \Exception $e){

            if ($e->hasResponse()) {

                $exception = (string) $e->getResponse()->getBody();
                $exception = json_decode($exception);

                throw new InvalidResponseException( $exception->error->message, 102);

              } else {
                throw new InvalidResponseException( $e->getMessage(), 102);
              }

        }

        if($this->result->getStatusCode() !== 200) {
            throw new InvalidResponseException( $this->result->getReasonPhrase(), 102);
        }

        return \json_decode($this->result->getBody()->getContents());

    }

}