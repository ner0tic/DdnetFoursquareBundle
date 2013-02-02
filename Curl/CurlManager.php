<?php
namespace Ddnet\FoursquareBundle\Curl\Manager;

class CurlManager 
{
    private 
        $key,
        $Curl;

    /**
     * 
     * @param string $key
     */
    public function __construct( $key )
    {
        $this->key = $key;
        $this->Curl = Curl::getInstance();
    }

    /**
     * Get item
     * 
     * @param string $name
     * @return object
     */
    public function __get( $name ) 
    {
        $responses = $this->Curl->getResult( $this->key );
      
        return isset( $responses[ $name ] ) ? $responses[ $name ] : null;
    }

    /**
     * Is item set
     * 
     * @param string $name
     * @return object
     */
    public function __isset( $name )
    {
        $val = self::__get( $name );
      
        return empty( $val );
    }
}
