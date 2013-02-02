<?php
namespace Ddnet\FoursquareBundle;

use Symfony\Compnent\DependencyInjection\ContainerInterface,

    Ddnet\FoursquareBundle\Foursquare\FoursquareBase,
    Ddnet\FoursquareBundle\Exception\FoursquareException,
    Ddnet\FoursquareBundle\Exception\FoursquareBadRequestException,
    Ddnet\FoursquareBundle\Exception\FoursquareNotFoundException;

 /**
 * Foursquare API wrapper
 *
 * @author david durost <david.durost@gmail.com>
 */
class Foursquare implements ContainerAwareInterface {
    protected static 
        $_foursquare        = false;
    protected 
        $requestTokenUrl    = 'https://foursquare.com/oauth2/authenticate',
        $accessTokenUrl     = 'https://foursquare.com/oauth2/access_token',
        $authorizeUrl       = 'https://foursquare.com/oauth2/authorize',
        $apiUrl             = 'https://api.foursquare.com';
    protected 
        $apiVersion         = 'v2',
        $isAsynchronous     = false,
        $followLocation     = false,
        $connectionTimeout  = 5,
        $requestTimeout     = 30,
        $debug              = false,
        $token              = null;
    /**
     * @var ContainerInterface $container 
     */
    protected 
        $container;

    /**
     * Set Access Token
     * 
     * @param string $token
     */
    public function setAccessToken( $token ) 
    { 
        $this->token = $token; 
    }
    
    /**
     * Set Timeout
     * 
     * @param $requestTimeout
     * @param $connectionTimeout
     */
    public function setTimeout( $requestTimeout = null, $connectionTimeout = null ) 
    {
        if( $requestTimeout !== null )
        {
            $this->requestTimeout = floatval( $requestTimeout );
        }
        
        if( $connectionTimeout !== null )
        {
            $this->connectionTimeout = floatval( $connectionTimeout );
        }
    }
    
    /**
     * Set which API version to use
     * 
     * @param string $version
     */
    public function useApiVersion( $version = null ) 
    { 
        $this->apiVersion = $version; 
    }
    
    /**
     * Use Asynchronous calls
     * 
     * @param boolean $async
     */
    public function useAsynchronous( $async = true ) 
    { 
        $this->isAsynchronous = ( bool ) $async; 
    }

    /**
     * Delete item
     * 
     * @param string $endpoint
     * @param array $params
     * @return boolean
     */
    public function delete( $endpoint, array $params = array() ) 
    { 
        return $this->request( 'DELETE', $endpoint, $params ); 
    }
    
    /**
     * Get item
     * 
     * @param string $endpoint
     * @param array $params
     * @return object
     */
    public function get( $endpoint, array $params = array() ) 
    { 
        return $this->request( 'GET', $endpoint, $params ); 
    }
    
    /**
     * Post item
     * 
     * @param string $endpoint
     * @param array $params
     * @return object
     */
    public function post( $endpoint, array $params = array() ) 
    { 
        return $this->request( 'POST', $endpoint, $params ); 
    }

    /**
     * @param Symfony\Compnent\DependencyInjection\ContainerInterface $container
     */
    public function __construct( ContainerInterface $container = null ) 
    { 
        $this->container = $container;
        $this->setAccessToken( $this->container->getParameter( 'api_key' ) ); 
    }
    
    /**
     * Get an instance of the Foursquare library
     * 
     * @return Ddnet\FoursquareBundle\Foursquare\Foursquare
     */
    public static function getFoursquareInstance() 
    {
        return new Foursquare();
    }
    
    /**
     * static function get get an item from an endpoint
     * @param string $endpoint
     * @param array $params
     * @param string $method
     * @return object
     * @throws FoursquareBadRequestException
     */
    public static function retrieve( $endpoint, array $params = array(), $method = 'get' ) 
    {
        $fs = new self();
        $method = strtolower( $method );
        switch( $method ) 
        {
            case 'get':
                return $fs->get( $endpoint, $params );
                break;
            case 'post':
                return $fs->post( $endpoint, $params );
                break;
            case 'delete':
                return $fs->delete( $endpoint, $params );
                break;
            default:
                throw new FoursquareBadRequestException( 'The given method is invalid.' );     
        }
    }

    /**
     * Get the url to the API
     * 
     * @param string $endpoint
     * @return object
     */
    private function getApiUrl( $endpoint ) 
    {
        if( !empty( $this->apiVersion ) )
        {
            return "$this->apiUrl/$this->apiVersion/$endpoint";
        }
        else
        {
            return "$this->apiUrl/$endpoint";
        }
    }

    /**
     * Make a request to the API server
     * 
     * @param string $method
     * @param string $endpoint
     * @param array $params
     * @return onject
     * @throws FoursquareNotFoundException
     * @throws FoursquareException
     */
    private function request( $method, $endpoint, array $params = array() ) 
    {
        if( preg_match( '#^https?://#', $endpoint ) )
        {
            $url = $endpoint;
        }
        else
        {
            $url = $this->getApiUrl( $endpoint );
        }

        if( $this->token )
        {
            $params[ 'oauth_token' ] = $this->token;
        }
        else  
        {
            throw new FoursquareNotFoundException( 'no oauth token found.' );
        }
      
        if( $method === 'GET' )
        {
            $url .= is_null( $params ) ? '' : '?'.http_build_query( $params, '', '&' );
        }

        // curl 
        $ch  = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_USERAGENT, "ddFetcher ".time() );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_TIMEOUT, $this->requestTimeout );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );

/**        
        if( isset( $_SERVER[ 'SERVER_ADDR' ] ) && !empty( $_SERVER[ 'SERVER_ADDR' ] ) && $_SERVER[ 'SERVER_ADDR' ] != '127.0.0.1' )
        {
            curl_setopt( $ch, CURLOPT_INTERFACE, $_SERVER[ 'SERVER_ADDR' ] );
        }
**/      
        if( $method === 'POST' && $params !== null )
 
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );

        $data = curl_exec( $ch );
        $meta = json_decode( $data, true );
        
        if( $meta[ 'meta' ][ "code" ] != 200 )
        {
            throw new FoursquareException( "error encountered getting data.<br />code: ".$meta[ 'meta' ][ "code" ]."<br />url: ".$url );
        }
      
        return $data;
    }
    
    /**
     * Set the container
     * 
     * @param Symfony\Compnent\DependencyInjection\ContainerInterface $container
     */
    public function setContainer( ContainerInterface $container )
    {
        $this->container = $container;
    }
}