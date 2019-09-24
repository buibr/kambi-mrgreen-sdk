<?php 

namespace buibr\KambiMrGreen\Base;

use GuzzleHttp\Client;
use buibr\KambiMrGreen\Base\Auth;
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
     * Query of the request.
     */
    protected $query = [];

    /**
     * Guzzle client
     */
    protected $client;

    /**
     * Results of the request
     */
    protected $result;

    /**
     * 
     */
    protected $headers = [
        'Accept' => 'application/json',
    ];

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
    public function setHeader( array $array ){
        $this->headers = array_merge($this->headers, $array);
    }

    /**
     * 
     */
    public function setQuery( array $query){
        return $this->query = array_merge($this->query, $query);
    }

    /**
     * 
     */
    public function getData(){

        if(empty($this->api) || empty($this->path)):
            throw new InvalidConfigException('Invalid configuration API or Path', 101);
        endif;

        $headers = ['Accept' => 'application/json',];

        try
        {

            // print "\n\nENDPOINT: {$this->api}{$this->path}\n\n";
            // print_r(['query'=>$query,'headers'=>$headers]);
            $this->result = $this->client->request('GET', $this->api . $this->path,[
                'query' => $query,
                'headers' => $headers
            ]);

        }
        catch( \Exception $e){

            if ($e->hasResponse()) {

                $exception = (string)$e->getResponse()->getBody();
                $exception = json_decode($exception);

                if(isset($exception->error) && isset($exception->error->message)):
                    throw new InvalidResponseException( $exception->error->message, 102);
                else:
                    throw new InvalidResponseException( strip_tags($e->getMessage()), 102);
                endif;

            } else {
                throw new InvalidResponseException( $e->getMessage(), 102);
            }

        }

        if($this->result->getStatusCode() !== 200) {
            throw new InvalidResponseException( $this->result->getReasonPhrase(), 102);
        }

        return \json_decode($this->result->getBody()->getContents());

    }

    /**
     * 
     */
    public function getQuery() {
        $query = [];
        if(!empty($this->query)) {
            $query = $this->query;
        }
        return $query;
    }

    /**
     * 
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * 
     */
    public function getEndpoint() {
        return $this->client->request('GET', $this->api . $this->path,[
            'query' => $this->getQuery(),
            'headers' => $this->getHeaders(),
        ]);
    }
}