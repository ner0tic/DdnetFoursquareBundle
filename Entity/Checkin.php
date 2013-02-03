<?php
namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\User,
    Ddnet\FoursquareBundle\Entity\Venue,
    Ddnet\FoursquareBundle\Entity\Photo;

class Checkin 
{
    protected 
        $id,
            
        $type = 'checkin',
        $user = null,
        $venue = null,
        $visibility = 'public',
        $shout = '',
            
        $createdAt,
        $timezoneOffset,
            
        $source = array(
            'name'    =>  '',
            'url'     =>  ''
        ),
        $photos = array(),
        
        $likes = array( 
            'count'   =>  0,
            'groups'  =>  array()
        ),
        $like = false,
            
        $score = array( 
            'scores'    => array( 
                'points'    =>  0,
                'icon'      =>  '',
                'message'   =>  ''
            ),
            'total'     =>  0
         );
    
    /**
     * Get Id
     * 
     * @return string
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
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setId( $id ) 
    { 
        $this->id = $id; 
     
        return $this; 
    }

    /**
     * Get Creation Date
     * 
     * @return datetime
     */
    public function getCreatedAt() 
    { 
        return $this->createdAt; 
    }
    
    /**
     * Set Creation Date
     * 
     * @param datetime $createdAt
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setCreatedAt( $createdAt ) 
    {
        $this->createdAt = $createdAt;
      
        return $this;    
    }

    /**
     * Get Type
     * 
     * @return string
     */
    public function getType() 
    { 
        return $type; 
    }
    
    /**
     * Set Type
     * 
     * @param string $type
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setType( $type ) 
    {
        $this->type = $type;
      
        return $this;
    }

    /**
     * Get Checking Visibility
     * 
     * @return boolean
     */
    public function getVisibility() 
    { 
        return $this->visibility; 
    }
    
    /**
     * Set Checkin Visibility
     * 
     * @param boolean $visibility
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setVisibility( $visibility ) 
    {
        $this->visibility = $visibility;
      
        return $this;
    }

    /**
     * Get Shout
     * 
     * @return string
     */
    public function getShout() 
    { 
        return $this->shout; 
    }
    
    /**
     * Set Shout
     * 
     * @param string $shout
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setShout( $shout ) 
    {
        $this->shout = $shout;
      
        return $this;
    }

    /**
     * Get Timezone Offset
     * 
     * @return integer
     */
    public function getTimezoneOffset() 
    { 
        return $this->timezoneOffset; 
    }
    
    /**
     * Set Timezone Offset
     * 
     * @param integer $offset
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setTimezoneOffset( $offset ) 
    {
        $this->timezoneOffset = $offset;
      
        return $this;
    }

    /**
     * Get User
     * @return \Ddnet\FoursquareBundle\Entity\User
     */
    public function getUser() 
    { 
        return $this->user; 
    }
    
    /**
     * Set User
     * 
     * @param \Ddnet\FoursquareBundle\Entity\User $user
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setUser( User $user ) 
    {
        $this->user = $user;      
      
        return $this;
    }

    /**
     * Get Venue
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function getVenue() 
    { 
        return $this->venue; 
    }
    
    /**
     * Set Venue
     * 
     * @param \Ddnet\FoursquareBundle\Entity\Venue $venue
     *
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setVenue( Venue $venue ) 
    {
        $this->venue = $venue;
      
        return $this;
    }

    /**
     * Get Source
     * 
     * @param array $format
     * 
     * @return string
     */
    public function getSource( $format = array() ) 
    {
        switch( $format ) 
        {
            case 'link':
                return '<a href="'.$this->source[ 'url' ].'">'.$this->source[ 'name' ].'</a>';
                break;
            default:
              return $this->source;
              break;
        }
    }
    
    /**
     * Set Source
     * 
     * @param array $source
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     * @throws FoursquareException
     */
    public function setSource( array $source ) 
    {
        if( !is_array( $source ) )
        {
            throw new FoursquareException( 'Source must be an array. {name,url}' );
        }
      
        $this->source = $source;
      
        return $this;
    }

    /**
     * Get Photos
     * 
     * @return array
     */
    public function getPhotos() 
    { 
        return $this->photos; 
    }
    
    /**
     * Set Photos
     * 
     * @param \Ddnet\FoursquareBundle\Entity\Photo $photos
     * @param boolean $merge
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     * @throws FoursquareException
     */
    public function setPhotos( array $photos = array(), $merge = false ) 
    {
        if( $merge ) {
            $this->photos = array_merge( $photos, $this->photos );
        }
        else
        {
            $this->photos = $photos;
        }
        
        return $this;
    }

    /**
     * Get Likes
     * 
     * @param type $count
     * 
     * @return integer|array
     */
    public function getLikes( $count = true ) 
    { 
        switch( $count ) 
        {
            case false:
                return $this->likes;
                break;
            default:
                return $this->likes[ 'count' ];
                break;
        }
    }
    
    /**
     * Set Likes
     * 
     * @param array $likes
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setLikes( $likes ) {
      $this->likes = $likes;
      return $this;
    }

    /**
     * Is Liked By Authed User
     * 
     * @return boolean
     */
    public function isLiked( $boolean = null ) 
    { 
        if( !is_null( $boolean ) )
        {
            $this->like = $boolean;
            
            return $this;
        }
        
        return $this->like; 
    }
    
    /**
     * Get Score
     * 
     * @param boolean $points
     * @return array
     */
    public function getScore( $points = true ) 
    {
        switch( $points ) 
        {
            case false:
              return $this->score;
              break;
            default:
              return $this->score[ 'points' ];
              break;
        }
    }
    
    /**
     * Set Score
     * 
     * @param array $score
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function setScore( $score ) 
    {
        $this->score = $score;
      
        return $this;
    }

    /**
     * Create Entity From An Array
     * 
     * @param array $array
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Checkin
     */
    public function fromArray( $array ) {
      if( isset( $array[ 'id' ] ) ) $this->setId( $array[ 'id' ] );
      if( isset( $array[ 'createdAt' ] ) ) $this->setCreatedAt( $array[ 'createdAt' ] );
      if( isset( $array[ 'type' ] ) ) $this->setType( $array[ 'type' ] );
      if( isset( $array[ 'visibility' ] ) ) $this->setVisibility( $array[ 'visibility' ] );
      if( isset( $array[ 'timezoneOffset' ] ) ) $this->setTimezoneOffset( $array[ 'timezoneOffset' ] );
      if( isset( $array[ 'shout' ] ) ) $this->setShout( $array[ 'shout' ] );
      if( isset( $array[ 'user' ] ) ) $this->setUser( $array[ 'user' ] );
      if( isset( $array[ 'venue' ] ) ) $this->setVenue( $array[ 'venue' ] );
      if( isset( $array[ 'source' ] ) ) $this->setSource( $array[ 'source' ] );
      if( isset( $array[ 'likes' ] ) ) $this->setLikes( $array[ 'likes' ] );
      if( isset( $array[ 'photos' ] ) ) $this->setPhotos( $array[ 'photos' ] );
      if( isset( $array[ 'like' ] ) ) $this->isLiked( $array[ 'like' ] );
      if( isset( $array[ 'score' ] ) ) $this->setScore( $array[ 'score' ] );
      
      return $this;
    }
}
