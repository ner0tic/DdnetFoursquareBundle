<?php
namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\Venue,
    Ddnet\FoursquareBundle\Entity\User;

class Tip
{
    protected
        $id,
        $createdAt      =   '',
        $text           =   '',
        $canonicalUrl   =   '',
        $likes          =   array(
            'count'     =>  0,
            'groups'    =>  array(),
            'summary'   =>  ''
        ),
        $like           =   false,
        $venue          =   null,
        $user           =   null,
        $todo           =   array(
            'count'     =>  0,
            'groups'    =>  array()
        ),
        $listed         =   array(
            'count'     =>  0,
            'groups'    =>  array()
        ),
        $saves          =   array(
            'count'     =>  0,
            'summary'   =>  '',
            'items'     =>  array()
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
     * @return \Ddnet\FoursquareBundle\Entity\Tip
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
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setCreatedat( $createdAt )
    {
        $this->createdAt = $createdAt;
        
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
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setText( $text )
    {
        $this->text = $text;
        
        return $this;
    }
    
    /**
     * Get Canonical URL
     * 
     * @return string
     */
    public function getCanonicalUrl()
    {
        return $this->canonicalUrl;
    }
    
    /**
     * Set Canonical URL
     * 
     * @param string $url
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setCanonicalUrl( $url )
    {
        $this->canonicalUrl = $url;
        
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
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setLikes( array $likes ) {
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
     * Get Venue
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
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setVenue( Venue $venue )
    {
        $this->venue = $venue;
        
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
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setUser( User $user )
    {
        $this->user = $user;
        
        return $this;
    }
    
    /**
     * Get Todo
     * 
     * @param type $count
     * 
     * @return integer|array
     */
    public function getTodo( $count = true ) 
    { 
        switch( $count ) 
        {
            case false:
                return $this->todo;
                break;
            default:
                return $this->todo[ 'count' ];
                break;
        }
    }
    
    /**
     * Set Todo
     * 
     * @param array $todo
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setTodo( array $todo ) {
      $this->todo = $todo;
      return $this;
    }    
    
    /**
     * Get Listed
     * 
     * @param type $count
     * 
     * @return integer|array
     */
    public function getListed( $count = true ) 
    { 
        switch( $count ) 
        {
            case false:
                return $this->listed;
                break;
            default:
                return $this->listed[ 'count' ];
                break;
        }
    }
    
    /**
     * Set Listed
     * 
     * @param array $listed
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setListed( array $listed ) {
      $this->listed = $listed;
      return $this;
    }    
    
    /**
     * Get Saves
     * 
     * @param type $count
     * 
     * @return integer|array
     */
    public function getSaves( $count = true ) 
    { 
        switch( $count ) 
        {
            case false:
                return $this->saves;
                break;
            default:
                return $this->saves[ 'count' ];
                break;
        }
    }
    
    /**
     * Set Saves
     * 
     * @param array $saves
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function setSaves( array $saves ) {
      $this->saves = $saves;
      return $this;
    }    
}