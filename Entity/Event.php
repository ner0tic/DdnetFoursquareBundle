<?php

namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\Category;

class Event 
{

    protected 
        $id,
        $name,
        $foreignIds = array(
            'count'   =>  0,
            'items'   => array()
        ),
        $categories = array(),
        $allDay = false,
        $date,
        $text,
        $url,
        $images = array(),
        $provider,
        $stats = array(
            'checkinsCount'   =>  0,
            'usersCount'      =>  0
        );
    
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
     * @param string $id
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setId( $id )
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * Get Name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set Name
     * 
     * @param string $name
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setName( $name )
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get Foreign Ids
     * 
     * @param boolean $count
     * @return integer|array
     */
    public function getForeignIds( $count = true )
    {
        if( $count ) 
        {
            return $this->foreignIds[ 'count' ];
        }
        
        return $this->foreignIds;           
    }
    
    /**
     * Get Arrays
     * @return array
     */
    public function getCategories() 
    { 
        return $this->categories; 
    }
    
    /**
     * Set Categories
     * 
     * @param array $categories
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     * @throws FoursquareException
     */
    public function setCategories(  array $categories = array()  ) 
    {
        $this->categories = $categories;
        
        return $this;
    }
    
    /**
     * Add A Category
     * 
     * @param \Ddnet\FoursquareBundle\Entity\Category $category
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     * @throws FoursquareException
     */
    public function addCategory( Category $category ) 
    {   
        $this->categories[] = $category;
      
        return $this;  
    }      
    
    /**
     * Is Event Lasting All Day
     * 
     * @param boolean $boolean
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function isAllDay( $boolean = null )
    {
        if( !is_null( $boolean ) )
        {
            $this->allDay = ( boolean ) $boolean;
            
            return $this;
        }
        
        return $this->allDay;
    }
    
    /**
     * Get Date
     * 
     * @param string $format
     * 
     * @return string
     */
    public function getDate( $format = null )
    {
        if( !is_null( $format ) )
        {
            return date( $this->date, $format );
        }
        
        return $this->date;
    }
    
    /**
     * Set Date
     * 
     * @param datetime $date
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setDate( $date )
    {
        $this->date = $date;
        
        return $this;
    }
    
    /**
     * Get Text
     * 
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Set Text
     * 
     * @param string $text

     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setText( $text )
    {
        $this->text = $text;
        
        return $this;
    }
    
    /**
     * Get URL
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Set URL
     * 
     * @param string $url
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setUrl( $url )
    {
        $this->url = $url;
        
        return $this;
    }
    
    /** 
     * Get Images
     * 
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }
    
    /**
     * Set Images
     * 
     * @param array $images
     * @param boolean $merge
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setImages( array $images = array(), $merge = false )
    {
        if( $merge )
        {
            $this->images = array_merge($this->images, $images );
        }
        else
        {
            $this->images = $images;
        }
        
        return $this;
    }
    
    /**
     * Add An Image
     * 
     * @param string $image
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function addImage( $image )
    {
        $this->images[] = $image;
        
        return $this;
    }
    
    /**
     * Get Provider
     * 
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    /**
     * Set Provider
     * 
     * @param string $provider
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Event
     */
    public function setProvider( $provider )
    {
        $this->provider = $provider;
                
        return $this;
    }
    
    /**
     * Get All Stats
     * 
     * @return array
     */
    public function getStats() 
    {
        return $this->stats;
    }
    
    /**
     * Get User Stats
     * 
     * @return array
     */
    public function getUserStats()
    {
        return $this->stats[ 'usersCount' ];
    }
    
    /**
     * Get Checkin Stats
     * 
     * @return array
     */
    public function getCheckinStats()
    {
        return $this->Stats[ 'checkinsCount' ];
    }
    
    public function setStats( array $stats = array(), $merge = false )
        {
        if( $merge )
        {
            $this->stats = array_merge( $this->stats, $stats );
        }
        else
        {
            $this->stats = $stats;
        }
        
        return $this;
    }
    
    public function setUserStats( array $stats = array(), $merge = false )
    {
        if( $merge )
        {
            $this->stats[ 'usersCount' ] = array_merge( $this->stats[ 'usersCount' ], $stats );
        }
        else
        {
            $this->stats[ 'usersCount' ] = $stats;
        }
        
        return $this;
    }
    
    public function setCheckinStats( array $stats = array(), $merge = false )
    {
        if( $merge )
        {
            $this->stats[ 'checkinsCount' ] = array_merge( $this->stats[ 'checkinsCount' ], $stats );
        }
        else
        {
            $this->stats[ 'checkinsCount' ] = $stats;
        }
        
        return $this;
    }
}

?>