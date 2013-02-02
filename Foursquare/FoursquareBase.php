<?php
namespace Ddnet\FoursquareBundle\Foursquare;

use Ddnet\FoursquareBundle\Exception\FoursquareNotFoundException,
    Ddnet\FoursquareBundle\Exception\FoursquareException;

class FoursquareBase implements ArrayAccess, Countable, IteratorAggregate 
{
    protected 
      $_array     = array();
    public 
      $id         = null,
      $createdAt  = null;

    /**
     * Get Id
     * 
     * @return integer
     */
    public function getId() 
    { 
        return $this->id; 
    }
    
    /**
     * Set Id
     * 
     * @param integer $id
     * @throws FoursquareNotFoundException
     */
    public function setId( $id ) 
    { 
        if( !is_null( $id ) )
        {
            $this->id = $id; 
        }
        else  
        {
            throw new FoursquareNotFoundException( 'given id is null.' );
        }
    }
    
    /**
     * @param integer $id
     * @param datetime|null $createdAt
     */
    public function __construct( $id, $createdAt = null ) 
    {
        $this->setId( $id ); 
        $this->createdAt( $createdAt );
    }
    
    /**
     * createdAt
     * 
     * @param datetime|null $date
     * @return datetime
     */
    public function createdAt( $date = null ) 
    { 
        if( is_null( $date ) )
        {
            return $this->createdAt; 
        }
        else 
        {
            $this->createdAt = $date;    
        }
    }

    /**
     * Genereate item from an array
     * 
     * @param array $array
     * @throws FoursquareNotFoundException
     */
    public function fromArray( array $array ) 
    {
        if( !isset( $a[ 'id' ] ) )  
        {
            throw new FoursquareNotFoundException( 'An id was not found in given array.' );
        }
        
        foreach( $a as $k => $v ) 
        {
            if( is_array( $v ) ) 
            {
                foreach( $v as $kk => $vv ) 
                {
                    $this->$k[ $kk ] = $vv;
                }
            }
            else  
            {
                $this->$k = $v;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function count() 
    { 
        return count($this->_array); 
    }
    
    /**
     * @inheritdoc
     */
    public function getIterator() 
    { 
        return new ArrayObject($this->_array); 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetExists($n) 
    { 
        return isset( $this->_array[ $n ] ); 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetGet( $n ) 
    { 
        return $this->_array[ $n ]; 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetSet( $n, $v ) 
    { 
        return $this->_array[ $n ] = $v; 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetUnset( $n ) 
    { 
        unset( $this->_array[ $n ] ); 
    }
}
