<?php
namespace Ddnet\FoursquareBundle\Curl;

class Curl 
{
    const 
        timeout = 3;
    static 
        $inst = null,
        $singleton = 0;
    private    
        $mc,
        $msgs,
        $running,
        $execStatus,
        $selectStatus,
        $sleepIncrement = 1.1,
        $requests = array(),
        $responses = array(),
        $properties = array();
    private static 
        $timers = array();

    /**
     * @throws Exception
     */
    function __construct()   
    {
        if( self::$singleton == 0 )
        {
            throw new Exception( 'This class cannot be instantiated by the new keyword.  You must instantiate it using: $obj = Curl::getInstance();' );
        }

        $this->mc = curl_multi_init();
        $this->properties = array(
          'code'  => CURLINFO_HTTP_CODE,
          'time'  => CURLINFO_TOTAL_TIME,
          'length'=> CURLINFO_CONTENT_LENGTH_DOWNLOAD,
          'type'  => CURLINFO_CONTENT_TYPE,
          'url'   => CURLINFO_EFFECTIVE_URL
        );
    }

    /**
     * Add curl call
     * 
     * @param  $ch
     * @return Ddnet\FoursquareBundle\Curl\CurlManager
     */
    public function addCurl( $ch ) 
    {
        $key = $this->getKey( $ch );
        $this->requests[ $key ] = $ch;
        curl_setopt( $ch, CURLOPT_HEADERFUNCTION, array(
            $this, 
            'headerCallback'
        ) );

        $code = curl_multi_add_handle($this->mc, $ch);
        $this->startTimer($key);

        if( $code === CURLM_OK || $code === CURLM_CALL_MULTI_PERFORM )
        {
            do {
                $code = $this->execStatus = curl_multi_exec( $this->mc, $this->running );
            } while( $this->execStatus === CURLM_CALL_MULTI_PERFORM );

            return new CurlManager( $key );
        }
        else 
        {
            return $code;
        }
    }

    /**
     * Get a result
     * 
     * @param string|null $key
     * 
     * @return null|boolean
     */
    public function getResult( $key = null ) 
    {
        if( $key != null )
        {
            if( isset( $this->responses[ $key ] ) ) 
            {
                return $this->responses[ $key ];
            }

            $innerSleepInt = $outerSleepInt = 1;
        
            while( $this->running && ( $this->execStatus == CURLM_OK || $this->execStatus == CURLM_CALL_MULTI_PERFORM ) )
            {
                usleep( $outerSleepInt );
                $outerSleepInt = intval( max( 1, ( $outerSleepInt * $this->sleepIncrement ) ) );
          
                $ms = curl_multi_select( $this->mc, 0 );
          
                if($ms > 0) {
                    do {
                        $this->execStatus = curl_multi_exec( $this->mc, $this->running );
                        usleep( $innerSleepInt );
                        $innerSleepInt = intval( max( 1, ( $innerSleepInt * $this->sleepIncrement ) ) );
                    } while( $this->execStatus == CURLM_CALL_MULTI_PERFORM );
                    $innerSleepInt = 1;
                }
                
                $this->storeResponses();
            
                if( isset( $this->responses[ $key ][ 'data' ] ) ) 
                {
                    return $this->responses[ $key ];
                }
          
                $runningCurrent = $this->running;
            }
        
            return null;
        }
      
        return false;
    }

    /**
     * Get sequence
     * @return \Ddnet\FoursquareBundle\Curl\Sequence
     */
    public static function getSequence() 
    {
        return new Sequence( self::$timers );
    }

    /**
     * Get Timers
     * @return object
     */
    public static function getTimers() 
    {
        return self::$timers;
    }

    /**
     * Get Key 
     * 
     * @param object $ch
     * @return object
     */
    private function getKey( $ch ) 
    {
      return ( string ) $ch;
    }

    /**
     * Get Header Callbacks
     * 
     * @param object $ch
     * @param object $header
     * @return integer
     */
    private function headerCallback( $ch, $header ) 
    {
        $_header = trim( $header );
        $colonPos= strpos( $_header, ':' );
        if( $colonPos > 0 )
        {
            $key = substr( $_header, 0, $colonPos );
            $val = preg_replace( '/^\W+/', '', substr( $_header, $colonPos ) );
            $this->responses[ $this->getKey( $ch ) ][ 'headers' ][ $key ] = $val;
        }
        return strlen( $header );
    }

    private function storeResponses() 
    {
        while( $done = curl_multi_info_read( $this->mc ) ) 
        {
            $key = ( string ) $done[ 'handle' ];
            $this->stopTimer( $key, $done );
            $this->responses[ $key ][ 'data' ] = curl_multi_getcontent( $done[ 'handle' ] );
            foreach( $this->properties as $name => $const ) 
            {
                $this->responses[ $key ][ $name ] = curl_getinfo( $done[ 'handle' ], $const );
            }
            curl_multi_remove_handle( $this->mc, $done[ 'handle' ] );
            curl_close( $done[ 'handle' ] );
        }
    }

    /**
     * Start Timer
     * 
     * @param string $key
     */
    private function startTimer( $key ) 
    {
        self::$timers[ $key ][ 'start' ] = microtime( true );
    }

    /**
     * Stop Timer
     * 
     * @param string $key
     * @param onject $done
     */
    private function stopTimer( $key, $done )
    {
        self::$timers[ $key ][ 'end' ] = microtime( true );
        self::$timers[ $key ][ 'api' ] = curl_getinfo( $done[ 'handle' ], CURLINFO_EFFECTIVE_URL );
        self::$timers[ $key ][ 'time' ] = curl_getinfo( $done[ 'handle' ], CURLINFO_TOTAL_TIME );
        self::$timers[ $key ][ 'code' ] = curl_getinfo( $done[ 'handle' ], CURLINFO_HTTP_CODE );
    }

    /**
     * Get an instance
     * 
     * @return object
     */
    static function getInstance() 
    {
        if( self::$inst == null )
        {
            self::$singleton = 1;
            self::$inst = new Curl();
        }

        return self::$inst;
    }
}
